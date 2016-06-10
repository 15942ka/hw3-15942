<?php include_once"index.html");?>
<!DOCTYPE HTML>
<html>
<head>
<style type="text/css">
/* Selects all the id's starting with 'div'*/
.holder #drag1, .holder #drag2{
    background-color: #87CEFA;
    transition:opacity 0.3s ease-in 0s;
}
.holder #drag2{
    opacity:0.0;
}
.holder{
    clear:both;
    padding:3em;
}
[id^="div"] {
    width: 80px;
    height: 80px;
    padding: 10px;
    border: 1px solid #aaaaaa;
    float:left;
    transition:background-color 0.3s linear 0s;
}
[id^="row"]{
    clear:both;
}
</style>
<script type="text/javascript">
function allowDrop(ev) {
    /* The default handling is to not allow dropping elements. */
    /* Here we allow it by preventing the default browser behaviour. */
    ev.preventDefault();
}
function drag(ev) {
    /* Here we specify what should be dragged. */
    /* This data will be dropped once the mouse button is released.*/
    /* Here,we set the data type 'text' also we want to drag the element itself, so we set it's ID.(ev.target.id) */
    ev.dataTransfer.setData("Text",ev.target.id);
}
function drop(ev) {
    /* Here we get the id of the image and store it is data*/
    var data=ev.dataTransfer.getData("Text");
    /* Here we 'append' (add after) them image to the target element*/
    /* We get the element to image by id stored in var data, then we only COPY it from DOM*/
    ev.target.appendChild(document.getElementById(data).cloneNode(true));
    /* Here we get the image then return it's id as a String.*/
    /* We then check to see whether it is 'drag1' OR 'drag2'*/
    /* Then change the background colour of the target respectively*/
    if(document.getElementById(data).id == "drag1"){
        ev.target.style.backgroundColor="blue";
    }else{
        ev.target.style.backgroundColor="white";
    }
    ev.preventDefault();
    ev.target.removeAttribute("ondragover");
    document.getElementById(data).removeAttribute("ondragstart");
    document.getElementById(data).setAttribute("draggable","false");
    switchTurn();
    checkRows();
}
var turn = 1;
function switchTurn(){
    if(turn == 1){
        document.querySelector('.holder #drag1').style.opacity="0.0";
        document.querySelector('.holder #drag2').style.opacity="1.0";
        turn++;
    }else{
        document.querySelector('.holder #drag1').style.opacity="1.0";
        document.querySelector('.holder #drag2').style.opacity="0.0";
        turn--;
    }
}
    var array = [[], [], []];
    var rowNum = 0;
function checkRows(){
    var rows = ["row1", "row2", "row3"];
    var timesRan = 0;
    for(i=0;i < 3;i++){
        var img = document.getElementById(rows[rowNum]).getElementsByTagName('div')[i].getElementsByTagName('img')[0].src;
        array[rowNum].push(img);
        if(timesRan < 1){
            array[rowNum].shift();
            timesRan++;
        }
        console.log(array);             
    }
    rowNum++;
}
</script>
<title>Drag & Drop Tic-Tac-Toe</title>
</head>
<body>
    <p>Drag the X and O images into the tic-tac-toe board:</p>
    <div id="row1">
    <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="div3" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    </div>
    <div id="row2">
    <div id="div4" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="div5" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="div6" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    </div>
    <div id="row3">
    <div id="div7" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="div8" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="div9" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    </div>
    <div class="holder">
    <img id="drag1" src="http://www.clipartbest.com/cliparts/dc6/aLj/dc6aLjxqi.png" draggable="true" 
        ondragstart="drag(event)" width="75" height="75" />
    <img id="drag2" src="http://demo.ksankaran.com/tictactoe/images/letter-o.jpg" draggable="true" 
        ondragstart="drag(event)" width="75" height="75" />
    </div>
</body>
</html>
