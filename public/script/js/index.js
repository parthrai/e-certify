if (document.getElementById("vid1")) {
  videojs("vid1").ready(function() {
	  
    
    var myPlayer = this;

    //Set initial time to 0
    var currentTime = 0;
	
	var maxTime=0;
	  var video_id = $('#video_id').val();
	  var next =parseInt(video_id)+parseInt(1);
	
    
    //This example allows users to seek backwards but not forwards.
    //To disable all seeking replace the if statements from the next
    //two functions with myPlayer.currentTime(currentTime);

    myPlayer.on("seeking", function(event) {
      if (currentTime < myPlayer.currentTime()) {
			console.log('current '+currentTime);
			console.log('max '+maxTime);
			if(currentTime == maxTime || !(myPlayer.currentTime() < maxTime)){
			myPlayer.currentTime(maxTime);
			}
			
			
      }
    });

    myPlayer.on("seeked", function(event) {
      if (currentTime < myPlayer.currentTime()) {
		  
		  if(currentTime == maxTime){
			console.log('seeked');
			myPlayer.currentTime(currentTime);
		  }
        
      }
    });


	  myPlayer.on("ended",function(event){

		  $.ajax({ //line 28
			  url: '../../updatevideodata',
			  type: 'POST',
			  data: { video_id: video_id },
			  success: function()
			  {
				  window.location.href = "https://ecertifyeducation.com/dashboard/video/"+next;
			  },
			  error: function(){
				  window.location.href = "https://ecertifyeducation.com/dashboard/video/"+next;

			  }
		  });
	  });

    setInterval(function() {
      if (!myPlayer.paused()) {
        currentTime = myPlayer.currentTime();
		
		
		
			if(maxTime<=currentTime){
					maxTime= currentTime;
			}
			var rand = Math.floor((Math.random() * 100) + 1);
		 console.log(Math.round(myPlayer.duration()));
		 
		 var totalduration=Math.round(myPlayer.duration());
		 var interval = Math.round(totalduration/4);
		console.log(currentTime);
		if(totalduration%2!=0){ 
			
			totalduration = totalduration +1;
			//console.log(interval +'interval');
		}
		
			var interval1= totalduration/4;
			var interval2= totalduration/3;
			var interval3=totalduration/2;

		if( Math.floor(currentTime)==interval1 ||  Math.floor(currentTime)==interval2 ||  Math.floor(currentTime)==interval3 ){
	  
		//	myPlayer.pause();
		//	console.log(Math.floor(currentTime));
			myPlayer.exitFullscreen();
			console.log('choot');



									$(document).ready(function(){
									//$.colorbox({html:"<h1>Some Random Text</h1>"});
										myPlayer.exitFullscreen();
									
									$.colorbox({
											html: "Some Random Text",
											close: "Close",	
											overlayClose: true,
              
											onClosed: function () {

													myPlayer.play();
											}

									});

									});
									
									
									
									
		}						
									
	
		
		
	
		
	
		}
      
    }, 1000);

  });
  
  
  
  
  
}