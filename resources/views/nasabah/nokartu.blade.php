@forelse($scanKartu as $item)
<div class="form-group" align="center">
    <label>Scan Your RFID Card</label>
    <br>
    <img src="{{ url('/upload/rfid.gif') }}"
        style="height: 100px;width:100px;" >
    <br>
    {{-- <img src="{{ url('/upload/animasi2.gif') }}"
        style="width:100px;"> --}}
    <input disabled type="text" name="nokartu" id="nokartu"
        placeholder="Tempelkan Kartu RFID" class="form-control"
        style="width: 200px;" value='{{ $item->nokartu }}'>
</div>
@endforeach
{{-- <script type="text/javascript">
$(document).ready(function(){
var castingNoKartu= document.getElementById('nokartu');
    castingNoKartu.addEventListener('change', function(evt) {
        alert(evt)
        // if (+evt.target.value < 18) {
        //   guarantorContainer.removeAttribute('hidden');
        //   guarantorIdentificationNumberContainer.removeAttribute('hidden');
        // } else {
        //   guarantorContainer.setAttribute('hidden', true);
        //   guarantorIdentificationNumberContainer.setAttribute('hidden', true);
        // }
    });
});
</script> --}}
