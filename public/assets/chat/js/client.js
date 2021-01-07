class Chat{
	constructor(options){
		// this.server = '//192.144.82.234:3000';
		this.server = 'https://youtalk.tel:3000';
		// this.server = '//0.0.0.0:3000';
		this.socket = null;
		this.isReady = false;
		this.options = options;

		// if(id == null){
		// 	console.error('please specify your id');
		// 	return false;
		// }
		// this.id = id;

		if(!options.hasOwnProperty('id')){
			console.error('please specify your id');
			return false;
		};
		this.id = options.id;

		this.name = 'undefined';
		if(options.hasOwnProperty('name')) this.name = options.name;
		else console.warn("you didn't specify a name.Default name will be shown.");
		
		this.pic = BASE_URL+'/assets/chat/images/default_user.png';
		if(options.hasOwnProperty('pic')) this.pic = options.pic;
		else console.warn("You didn't specify your pic.Default pic will be shown.");

		this.limit = null;
		if(options.hasOwnProperty('limit')) this.limit = options.limit;
		else console.warn("no limit for this call.");

		this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js', this.init.bind(this));
	}
	loadScript(url, callback){
	    var script = document.createElement("script")
	    script.type = "text/javascript";

	    if (script.readyState){  //IE
	        script.onreadystatechange = function(){
	            if (script.readyState == "loaded" || script.readyState == "complete"){
	                script.onreadystatechange = null;
	                callback();
	            }
	        };
	    } else {  //Others
	        script.onload = function(){
	            callback();
	        };
	    }

	    script.src = url;
	    document.getElementsByTagName("head")[0].appendChild(script);
	}
	init(){
		console.log('this is working');
		this.socket = io(this.server);
		this.initEvents();
	}
	initEvents(){
		this.socket.on('connect', this.connect.bind(this));
		this.socket.on('disconnect', this.disconnect.bind(this));
		this.socket.on('call', this.onCall.bind(this));
		this.socket.on('join', this.onJoin.bind(this));
	}
	connect(){
		console.log('connected to the server');
		// this.send('join', {
		// 	'id'		: this.id,
		// 	'name'		: this.name,
		// 	'pic'		: this.pic	
		// });
		this.send('join', {
			id: this.id
		});
	}
	disconnect(){
		this.isReady = false;
		console.log('disconnected from server');
	}
	onCall(data){
		if(data.status == false){
			this.closeCall();
			alert('お使いのブラウザはサポートされていません!');
			return false;
		}
		if(navigator.mediaDevices == undefined){
			this.send('call', {
				'to_id' 		: data.id,
				'id'			: this.id,
				'name'			: this.name,
				'pic'			: this.pic,
				'limit'			: this.limit,
				'room'			: [data.id,this.id].sort().join(''),
				'callback'		: {
									'callback_url'	: this.options.callback_url,
									'callback_data'	: this.options.callback_data
								},
				'status' 		: false
			});
			alert('お使いのブラウザはサポートされていません!');
			return false;
		}
		console.log(data);
		let that = this;
		var a = document.createElement("button");
		document.body.appendChild(a);
		a.addEventListener('click', () => {
			this.openCallWIndow(data, 'incoming');
		})
        a.click();
	}
	onJoin(data){
		console.log('joined to the server');
		this.isReady = true;
	}
	call(data, type = 'dialing'){
		if(navigator.mediaDevices == undefined){
			alert('お使いのブラウザはサポートされていません!');
			return false;
		}
		if(!this.isReady){
			console.error('some error occured,please refresh the page and try again');
			return false;
		}
		this.send('call', {
			'to_id' 		: data.id,
			'id'			: this.id,
			'name'			: this.name,
			'pic'			: this.pic,
			'limit'			: this.limit,
			'room'			: [data.id,this.id].sort().join(''),
			'callback'		: {
								'callback_url'	: this.options.callback_url,
								'callback_data'	: this.options.callback_data
							}
		});
		this.openCallWIndow(data, type);
	}

	openCallWIndow(data, type){
		if(!this.isReady){
			console.error('some error occured,please refresh the page and try again');
			return false;
		}
		let baseURI = BASE_URL+'/chat';
		let w = 480;
		let h = 600;
		let left = (screen.width/2)-(w/2);
  		let top = (screen.height/2)-(h/2);
  		let URI = baseURI+'?id='+this.id+'&to_id='+data.id+'&name='+data.name+'&pic='+data.pic+'&type='+type+'&limit='+data.limit;


  		let html = '<div class="modal chat-modal" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-body" style="height:600px;padding:0px;"><iframe border="0" src="'+URI+'" width="100%" height="100%"></iframe></div></div></div></div>';
  		$('.chat-modal').remove();
  		document.body.innerHTML += html;
  		// document.body.appendChild(html);
  		$('.chat-modal').show();
		// window.open(
		// 	URI,
		// 	'ATOMCHAT',
		// 	'directories=no, titlebar=no, toolbar=no, location=no, status=no, menubar=no, scrollbars=no, resizable=no, width='+w+', height='+h+', top='+top+', left='+left
		// );
	}

	closeCall(){
		$('.chat-modal').hide();
		$('.chat-modal').remove();
		location.reload();
	}

	send(event, data){
		console.log(event, data);
		if(this.socket == null) return false;
		this.socket.emit(event, data);
	}
}