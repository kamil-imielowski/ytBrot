var e=document.createElement('div');
e.id='blocked';
e.style.display='none';
document.body.appendChild(e);

if(!document.getElementById('blocked')){
    document.getElementById('dont-block').style.display='block';
}


$('#close-window').click(function(){
    $('#dont-block').fadeOut(600);
});