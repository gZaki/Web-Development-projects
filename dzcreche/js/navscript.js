/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
    document.getElementById("mySidenav").style.width = "20%";
	document.getElementById('logo').style.height="150px";
	document.getElementById('logo').style.width="150px";
	document.getElementById('logo').style.padding="10px";
	document.getElementById('logo').style.margin="auto";
    document.getElementById('rottaed').style.transform="rotate(-90deg)";
	var query = document.getElementsByClassName("hidden-xss");
	if(query[0].style.display=="none"){
	for(var i=0;i<query.length;i++){
		query[i].style.display="inline";
	}
  }
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
    document.getElementById("mySidenav").style.width = "3%";
	
  var query = document.getElementsByClassName("hidden-xss");
  for(var i=0;i<query.length;i++){
    query[i].style.display="none";
  }
  document.getElementById("logo").style.width="30px";
  document.getElementById("logo").style.height="30px";
  document.getElementById("logo").style.padding="0px";
  document.getElementById('rottaed').style.transform="rotate(90deg)";
}

function affiche(i){
    var query =document.getElementsByClassName('submenu');
    if(query[i].style.display==="none"){
            query[i].style.display="block";
            document.getElementsByClassName('drop')[i].style.transform="rotate(180deg)";
    }else{
            query[i].style.display="none";
            document.getElementsByClassName('drop')[i].style.transform="rotate(360deg)";
    }
}