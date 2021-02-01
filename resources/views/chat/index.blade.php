<!DOCTYPE html>
<html>
<head>
	<title>ココテル</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://kit.fontawesome.com/d4552da157.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/assets/chat/css/main.css">
</head>
<body>
	<div id="app">
		<div id="loading" class="loading text-center">
			<div class="main">
				<div class="fa-5x">
				  <i class="fas fa-cog fa-spin"></i>
				</div>
				<h2>Loading, please wait....</h2>
			</div>
		</div>
		<!-- <audio id="audio" autoplay></audio> -->
		<!-- <video id="remoteVideo" autoplay></video> -->
		<audio id="remoteAudio" autoplay="" controls=""></audio>
		<div class="header">
			<p>
				<h3>@{{name}}</h3>
			</p>
			<p>
				<template v-if="noAnswer">No answer...</template>
				<template v-else>
					<tempate v-if="callEnded">
						<div class="text-danger">Call ended</div>
						<div class="text-danger" v-if="cross_limit">out of balance</div>
						<div v-if="summary" class="summary"><span v-html="summary_text"></span></div>
					</tempate>					
					<tempate v-else>
						<span v-if="!onCall && incoming" class="text-info">Calling...</span>
						<span v-if="onCall">@{{totalTime}}</span>
						<span v-if="!onCall && dialing" class="text-info">Dialing...</span>
					</tempate>
				</template>
			</p>
		</div>
		<div class="main">
			<img :src="pic">
		</div>
		<div class="footer">
			<div class="row">
				<div v-if="onCall" class="col" @click="toogleMic">
					<span v-if="mic" class="item">
						<i class="fas fa-microphone"></i>
					</span>
					<span v-else class="item">
						<i class="fas fa-microphone-slash"></i>
					</span>
				</div>
				<div v-if="onCall" class="col" @click="toggleSpeaker">
					<span :class="[speaker?'active':'', mic && mobile()?'':'disabled']" class="item">
						<i class="fas fa-volume-up"></i>
					</span>
				</div>
				<div class="col" @click="accept" v-if="!onCall && incoming && !callEnded">
					<span class="item accept">
						<i class="fas fa-phone"></i>
					</span>
				</div>
				<div class="col" @click="cancel" v-if="(onCall || incoming || dialing) && !callEnded">
					<span class="item cancel">
						<i class="fas fa-phone-slash"></i>
					</span>
				</div>
				<div class="col" @click="cancel" v-if="callEnded">
					<span class="item cancel">
						<i class="fas fa-times"></i>
					</span>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	    let BASE_URL = '{{request()->root()}}';
	</script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/7.3.0/adapter.min.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
	<script type="text/javascript" src="/assets/chat/js/main.js"></script>
</body>
</html>