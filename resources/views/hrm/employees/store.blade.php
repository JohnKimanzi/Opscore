<!DOCTYPE html>
<html>
    <head>
<style>
    html,
body {
  display: flex;
  align-items:center;
  flex-direction: column;
  justify-content: center;
  min-height: 100%
}

label {
  display: block;
  font-size: 15px;
  padding: 10px 0;
}
input {
  border: 2px solid #1E824C;
  color: #333;
  font-size: 12px;
  padding: 5px 3px
}
small {
  display: block;
  font-size: 11px;
  padding-top: 5px;
}
</style>
    </head>
    <body>
        <form action="{{route('employees.store')}}" method="POST">
            @csrf
            <label for="authors">Type authors </label>
            <input type="text" list="names-list" id="authors" value="" size="50" name="authors" placeholder="Type author names">
            <small>You can type how many you want.</small>
            <datalist id="names-list">
            <option value="Swahili">
            <option value="Kamba">
            <option value="German">
            <option value="English">
            <option value="Spanish">
                <option value="French">
            </datalist>
        </form>
    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script>
    var datalist = jQuery('datalist');
var options = jQuery('datalist option');
var optionsarray = jQuery.map(options ,function(option) {
        return option.value;
});
var input = jQuery('input[list]');
var inputcommas = (input.val().match(/,/g)||[]).length;
var separator = ',';
        
function filldatalist(prefix) {
    if (input.val().indexOf(separator) > -1 && options.length > 0) {
        datalist.empty();
        for (i=0; i < optionsarray.length; i++ ) {
            if (prefix.indexOf(optionsarray[i]) < 0 ) {
                datalist.append('<option value="'+prefix+optionsarray[i]+'">');
            }
        }
    }
}
input.bind("change paste keyup",function() {
    var inputtrim = input.val().replace(/^\s+|\s+$/g, "");
  //console.log(inputtrim);
    var currentcommas = (input.val().match(/,/g)||[]).length;
  //console.log(currentcommas);
    if (inputtrim != input.val()) {
        if (inputcommas != currentcommas) {
            var lsIndex = inputtrim.lastIndexOf(separator);
            var str = (lsIndex != -1) ? inputtrim.substr(0, lsIndex)+", " : "";
            filldatalist(str);
            inputcommas = currentcommas;
        }
        input.val(inputtrim);
    }
});
</script>
