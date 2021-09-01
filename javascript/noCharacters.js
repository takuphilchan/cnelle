	/*code: 48-57 Numbers
	  8  - Backspace,
	  35 - home key, 36 - End key
	  37-40: Arrow keys, 46 - Delete key*/
      function restrictAlphabets(e){
		var x=e.which||e.keycode;
		if((x>=48 && x<=57) || x==8 ||
			(x>=35 && x<=40)|| x==46)
			return true;
		else
			return false;
	}