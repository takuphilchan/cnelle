
setTimeout(() => {
    if(document.getElementById('message').scrollTop<=(document.getElementById('message').scrollHeight)){
    document.getElementById('message').scrollTop=document.getElementById('message').scrollHeight-(document.getElementById('message').clientHeight);
 } 
},1); 