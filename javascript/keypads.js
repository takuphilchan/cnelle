
	/*code: 48-57 Numbers
	  8  - Backspace,
	  35 - home key, 36 - End key
	  37-40: Arrow keys, 46 - Delete key*/
      function restrictAlphabets(e){
		var x=e.which||e.keycode;
		if((x>=48 && x<=57) || x==8||
			(x>=35 && x<=40)|| x==43|| x==46)
			return true;
		else
			return false;
    }
    function restrictNumbers(e){
		var y=e.which||e.keycode;
		if((y>=65 && y<=90)||(y>=97 && y<=122) || y==32 || y==43 || y==8 ||
			(y>=35 && y<=40)|| y==46)
			return true;
		else
			return false;
	}

  $(function() {
        $('#compName').on('keypress', function(e) {
            if (e.which == 32){
                return false;
            }
        });
});

$(function() {
        $('#username').on('keypress', function(e) {
            if (e.which == 32){
                return false;
            }
        });
});
