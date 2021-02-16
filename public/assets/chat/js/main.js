// const socket = io('//192.144.82.234:3000');
const socket = io('https://youtalk.tel:3000');
// const socket = io('//0.0.0.0:3000');

let app = new Vue({
	el: '#app',
	data:{
		mic 			: true,
		speaker 		: false,
		incoming 		: false,
		onCall	 		: false,
		callEnded 		: false,
		dialing 		: false,
		noAnswer 		: false,

		id 				: 'Unknown',
		to_id 			: 'Unknown',
		name 			: 'Unknown',
		pic 			: './assets/chat/images/default_user.png',
		limit			: null,
		cross_limit 	: false,
 
		pcConfig		: {
					  		'iceServers': [
							    {
							      'urls': 'stun:stun.l.google.com:19302'
							    },
							    {
								    urls: 'turn:numb.viagenie.ca',
								    credential: 'muazkh',
								    username: 'webrtc@live.com'
								},
								{
								    urls: 'turn:192.158.29.39:3478?transport=udp',
								    credential: 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
								    username: '28224511:1379330808'
								},
								{
								    urls: 'turn:192.158.29.39:3478?transport=tcp',
								    credential: 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
								    username: '28224511:1379330808'
								},
								{
								    urls: 'turn:turn.bistri.com:80',
								    credential: 'homeo',
								    username: 'homeo'
								 },
								 {
								    urls: 'turn:turn.anyfirewall.com:443?transport=tcp',
								    credential: 'webrtc',
								    username: 'webrtc'
								}
							]
							
						},
		offerOptions    :{
							offerToReceiveAudio: 1,
							offerToReceiveVideo: 0,
						  	voiceActivityDetection: false
						},
		room 			: null,
		localStream   	: null,
		offerer 		: null,
		answerer 		: null,
		pc 				: null,
		initiator 		: false,
		loading	        : true,
		time 			: 0,
		totalTime 		: '00:00:00',
		audio 			: new Audio(BASE_URL+'/assets/chat/sounds/1.wav'),
		dialTime 		: 0,
		dialingTimer	: null,
		callback_url 	: null,
		callback_data	: null,
		summary 	 	: false,
		summary_text 	: null
	},
	created(){
		let that = this;
		window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
	    window.RTCSessionDescription = window.mozRTCSessionDescription || window.RTCSessionDescription;
	    window.RTCIceCandidate = window.mozRTCIceCandidate || window.RTCIceCandidate;
	    navigator.getUserMedia = navigator.getUserMedia || navigator.mozGetUserMedia || navigator.webkitGetUserMedia;
	    window.URL = window.webkitURL || window.URL;


	 //    window.addEventListener('beforeunload', (event) => {
		//   // Cancel the event as stated by the standard.
		//   // event.preventDefault();
		//   // Chrome requires returnValue to be set.
		//   this.cancel();
		// });


		window.onunload = window.onbeforeunload = function (event) {
			event.preventDefault();
		    var message = 'Sure to close?';
		    if (typeof event == 'undefined') {
		        event = window.event;
		    }
		    if (event) {
		        // event.returnValue = message;
		    }
		    // return message;
		    that.cancel();
		};
	},
	mounted(){
		// code here
		console.log('mounted');
		// this.loading = false;
		this.audio.loop = true;
		this.id = this.getUrlParam('id', 'Unknown');
		this.to_id = this.getUrlParam('to_id', 'Unknown');
		this.name = this.getUrlParam('name', 'Unknown');
		this.limit = this.getUrlParam('limit', null);
		this.pic = this.getUrlParam('pic', './assets/chat/images/default_user.png');
		this.incoming = this.getUrlParam('type') == 'incoming'?true:false;
		this.dialing = this.getUrlParam('type') == 'dialing'?true:false;
		this.initEvents();
	},
	computed:{
		// code here
	},
	watch:{
		// code here
		loading(newVal){
			if(newVal) document.getElementById('loading').style.display = 'block';
			else document.getElementById('loading').style.display = 'none';
		}
	},
	methods:{

		// code here

		toogleMic(){
			this.mic = !this.mic;
			if(this.mic){
				this.localStream.getAudioTracks()[0].enabled = true;
			}else{
				this.localStream.getAudioTracks()[0].enabled = false;
			}

		},

		toggleSpeaker(){
			if(this.mobile()){
				this.speaker = !this.speaker;
			}
			
		},

		accept(){
			if(!this.onCall){
				this.onCall = true;
				this.startTimer();
			}
			this.doAnswer();
		},
		cancel(){
			this.sendMessage('bye');
			
			this.stop();
			// call api
			// this.closeWindow();
		},
		sendMessage(message) {
		  	console.log('Client sending message: ', message);
		  	socket.emit('message', message);
		},
		captureMedia(){
			if(navigator.mediaDevices == undefined){
				this.cancel();
				alert('Your browser is not supported,please try another browser.');
				this.closeWindow();
				return false;
			}
			navigator.mediaDevices.getUserMedia({
			  	audio: true,
			  	video: false
			})
			.then(this.gotStream.bind(this))
			.catch(function(e) {
			  	console.error(e);
			});
		},
		gotStream(stream) {
		  	console.log('Adding local stream.');
		  	console.log(stream);
		  	this.localStream = stream;
		  	this.joinRoom();
		  	// this.createPeer();
		  	// this.pc.addStream(stream);
		},
		initEvents(){
			let that = this;
			socket.on('connect', () => {
				console.log('client connected');
			});
			socket.on('disconnect', () => {
				console.log('client disconnected');
			});
			socket.on('created', function(room) {
			  	console.log('Created room ' + room);
			  	that.initiator = true;
			});
			socket.on('full', function(room) {
			  	console.log('Room ' + room + ' is full');
			});
			socket.on('join', function (room){
			  	console.log('Another peer made a request to join room ' + room);
			  	console.log('This peer is the initiator of room ' + room + '!');
			});
			socket.on('joined', function(data) {
			  	console.log('joined: ' + data);
			  	that.callback_url = data.callback.callback_url;
			  	that.callback_data = data.callback.callback_data;
			  	that.start();
			});

			socket.on('log', function(array) {
			  	console.log.apply(console, array);
			});
			socket.on('message', function(message) {
			  	console.log('Client received message:', message);
			  	if (message.type === 'offer') {
			    	that.start();
			    	that.pc.setRemoteDescription(new RTCSessionDescription(message));		    	
			 	} else if (message.type === 'answer') {
			    	that.pc.setRemoteDescription(new RTCSessionDescription(message));
			  	} else if (message.type === 'candidate') {
			    	var candidate = new RTCIceCandidate({
				      	sdpMLineIndex: message.label,
				      	candidate: message.candidate
				    });
			    	that.pc.addIceCandidate(candidate);
			  	} else if (message === 'bye') {
			    	that.stop();
			  	}
			});

			that.captureMedia();
		},

		joinRoom(){
			this.room = [this.getUrlParam('id'),this.getUrlParam('to_id')].sort().join('');
			console.log(this.room);
			socket.emit('create_or_join', this.room);
		},
		start(){
			let that = this;
			that.loading = false;
			that.audio.play();
			that.createPeerConnection();
			// this.pc.addTrack(this.localStream);

			that.localStream.getTracks().forEach(track => this.pc.addTrack(track, that.localStream));
			// if(this.initiator){
			// 	this.doCall();
			// }
			if(that.dialing){
				that.dialingTimer = setInterval(function(){
					that.dialTime += 1;
					if(that.dialTime > 60) {
						that.stop();
						that.onCall = false;
						that.dialing = false;
						that.noAnswer = true;
						that.dialTime = 0;
						that.sendMessage('bye');
						clearInterval(that.dialingTimer);
					}
				}, 1000);
				that.doCall();
			}
		},


		// -----------------------------------------------------------
		
		createPeerConnection() {
			try {
				this.pc = new RTCPeerConnection(this.pcConfig);
				this.pc.onicecandidate = this.handleIceCandidate;
				this.pc.ontrack = this.handleRemoteStreamAdded;
				this.pc.onremovetrack = this.handleRemoteStreamRemoved;
				console.log('Created RTCPeerConnnection');
			} catch (e) {
				console.log('Failed to create PeerConnection, exception: ' + e.message);
				alert('Cannot create RTCPeerConnection object.');
				return;
			}
		},
		handleIceCandidate(event){
			console.log('icecandidate event: ', event);
			if (event.candidate) {
				this.sendMessage({
					type: 'candidate',
					label: event.candidate.sdpMLineIndex,
					id: event.candidate.sdpMid,
					candidate: event.candidate.candidate
				});
			} else {
				console.log('End of candidates.');
			}
		},
		handleRemoteStreamAdded(event){
			// if(this.initiator && !this.onCall){
			// 	this.onCall = true;
			// 	this.startTimer();
			// }
			if(this.dialing && !this.onCall){
				this.onCall = true;
				this.startTimer();
			}
			console.log('remote stream added');
			this.remoteStream = event.streams[0];
			console.log(event);
			let reomteAudioElement = document.querySelector('#remoteAudio');
			reomteAudioElement.srcObject = this.remoteStream;
			
		},
		handleRemoteStreamRemoved(event){
			console.log('remote stream removed');
			console.log(event);
		},
		// -----------------------------------------------------------

		doCall() {
		  	console.log('Sending offer to peer');
		  	this.pc.createOffer(this.offerOptions).then(this.setLocalAndSendMessage.bind(this), this.handleCreateOfferError.bind(this));
		},

		doAnswer() {
		  	console.log('Sending answer to peer.');
		  	this.pc.createAnswer().then(
		    	this.setLocalAndSendMessage.bind(this),
		    	this.onCreateSessionDescriptionError.bind(this)
		  	);
		},

		setLocalAndSendMessage(sessionDescription) {
		  	this.pc.setLocalDescription(sessionDescription);
		  	// console.log('setLocalAndSendMessage sending message', sessionDescription);
		  	this.sendMessage(sessionDescription);
		},

		handleCreateOfferError(event) {
		  	console.log('createOffer() error: ', event);
		},

		onCreateSessionDescriptionError(error) {
		  	// this.trace('Failed to create session description: ' + error.toString());
		},


		// --------------------------------------------------------------------

		stop() {
			let that = this;
			this.audio.pause();
			if(this.localStream){
				this.localStream.getTracks().forEach(track => track.stop());
			}
			if(this.pc){
				this.pc.close();
			}		  	
		  	this.pc = null;
		  	


			if(this.onCall && this.callback_url){
				// this.sendMessage({type: 'end', id: this.id, duration: this.time});
				that.callback_data.duration = this.time;
				that.callback_data.entry = this.dialing?true:false;
				console.log('that.callback_data');
				console.log(that.callback_data);
				that.loading = true;
				axios.get(that.callback_url, {
					params: that.callback_data
				})
				.then(function (response) {
					console.log(response.data);
					that.summary = true;
					that.summary_text = 'Talk time: '+that.processTimeToString(response.data.duration)+'<br> Free time: '+that.processTimeToString(response.data.free_time)+'<br> Amount: '+response.data.total_cost+' JPY';
				})
				.catch(function (error) {
					console.log(error);
				})
				.then(function () {
				// always executed
					console.log('api called');
					that.loading = false;
					that.closeWindow();
				});  
				
			}else{
				this.closeWindow();
			}

			this.onCall = false;
			this.stopTimer();
		  	this.callEnded = true;
		  	
		},

		closeWindow(){
			// window.open('','_self').close();
			console.log(parent);
			parent.chat.closeCall();

		},

		startTimer(){
			console.log('timer started');
			var that = this;
			that.audio.pause();
			clearInterval(that.dialingTimer);
			that.dialTime = 0;
			that.timer = setInterval(that.processTime.bind(that), 1000);
			if(that.dialing && that.callback_data.sellerId){
				axios.get('https://YouTalk.tel/engage-seller', {
					params: that.callback_data
				})
				.then(function (response) {
				})
				.catch(function (error) {
				})
				.then(function () {
				});  
				
			}
		},

		stopTimer(){
			if(this.timer){
				clearInterval(this.timer);
			}
			this.time = 0;
		},

		processTime(){
			this.time ++;
			let hours = Math.floor(this.time / 60 / 60);
			let minutes = Math.floor(this.time / 60) - (hours * 60);
			let seconds = this.time % 60;
			this.totalTime = hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
			if(this.dialing && this.limit != null && this.time >= this.limit) {
				this.cross_limit = true;
				this.cancel();
			}
		},

		processTimeToString(time){
			let hours = Math.floor(time / 60 / 60);
			let minutes = Math.floor(time / 60) - (hours * 60);
			let seconds = time % 60;
			return hours.toString().padStart(2, '0') + 'h ' + minutes.toString().padStart(2, '0') + 'm ' + seconds.toString().padStart(2, '0')+'s';
		},

		getUrlParam(parameter, defaultvalue){
		    var urlparameter = defaultvalue;
		    if(window.location.href.indexOf(parameter) > -1){
		        urlparameter = new URL(location.href).searchParams.get(parameter);
		    }
		    if(urlparameter == '') urlparameter = defaultvalue;
		    return urlparameter;
		},
		mobile() {
		    const toMatch = [
		        /Android/i,
		        /webOS/i,
		        /iPhone/i,
		        /iPad/i,
		        /iPod/i,
		        /BlackBerry/i,
		        /Windows Phone/i
		    ];

		    return toMatch.some((toMatchItem) => {
		        return navigator.userAgent.match(toMatchItem);
		    });
		}
	}
});