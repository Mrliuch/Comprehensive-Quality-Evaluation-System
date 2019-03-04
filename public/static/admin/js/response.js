function selectImage(file){
 if(!file.files || !file.files[0]){
return;
 }
  var reader = new FileReader();
 reader.onload = function(evt){
 document.getElementById('image').src = evt.target.result;
 image = evt.target.result;
}
reader.readAsDataURL(file.files[0]);
}
function addpic(){
  document.getElementById('image').style.display='block';
  document.getElementById('div_j').style.display='none';
  document.getElementById('div_addpic').style.display='none';
}