
 function checkall(class_name, obj){
	var items = document.getElementsByClassName(class_name);
	if(obj.checked ==true){
		for(i=0; i< items.length;i++){
			items[i].ckecked=true;
			
		}
	}
}// JavaScript Document