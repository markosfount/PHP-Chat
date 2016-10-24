	var last_time=0;
		//this is to keep the scroll on messages window always at the bottom
		$(window).onload=function(){($('#messages').scrollTop($('#messages')[0].scrollHeight))};
		
		// this functions makes an ajax call whenever a message is sent by pressing enter in the textarea
		// and calls the backend script to insert message in db
		
		function sendText(){
			$('#writehere')[0].onkeydown=function(e){
				if (e.keyCode==13){
					e.preventDefault();
					if (this.value){
						var datatosend={"text":this.value};
						$.ajax({
							type:"POST",
							url:"index.php",
							data:datatosend,
							datatype:"json",
							success:function(data){}
						})
						this.value='';
					}
				}
			}
		}
		
		//this function makes an ajax call to see if there are any new messages
		//when new messages are returned from the server the function calls itself again
		
		function checkText(){
			$.ajax({
				type:"POST",
				url:"index.php",
				data:{time:last_time},
				datatype:"json",
				success:function(data){
					if (data){
						data=JSON.parse(data);
						for (var i=0; i<data.length; i++){
							$('#messages').append('<p>'+ (setDateTime(data[i].TIME)) + ' ' + data[i].USER + ':'+ ' ' +data[i].MESSAGE +'</p>');
						}
						last_time=Date.now()/1000;
						$('#messages').scrollTop($('#messages')[0].scrollHeight);
					}
					checkText();
				}
			});					
		}	
		
		//return date and time in a printable format
		
		function setDateTime(timedate){
			var tempdate=new Date(timedate*1000),
			date=TwoDigits(tempdate.getDate()),
			month=TwoDigits(tempdate.getMonth()+1),
			year=tempdate.getFullYear(),
			hours=TwoDigits(tempdate.getHours()),
			mins=TwoDigits(tempdate.getMinutes()),
			sec=TwoDigits(tempdate.getSeconds());
			return (year+'-'+month+'-'+date+' '+hours+':'+mins+':'+sec );
		}
		//return any one-digit number to two digits to be printed
		
		function TwoDigits(number){
			return (number<10 ? '0' : '') + number;
		}
		
		//run functions to enable chat
		
		sendText();
		checkText();
		
		