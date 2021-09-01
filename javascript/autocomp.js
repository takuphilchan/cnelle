
        $('.name').attr('autocomplete', 'nope');
        function turnOnPasswordStyle() {
       $('#password-field').attr('type', "password");
        }

        var vids = function(event) {
          var vid = document.getElementById('vidplace');
          vid.src = URL.createObjectURL(event.target.files[0]);
        };