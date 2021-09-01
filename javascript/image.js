var loadFile = function(event) {
	var image = document.getElementById('imgplace');
	image.src = URL.createObjectURL(event.target.files[0]);
};


