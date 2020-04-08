<link href="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" rel="script" >

<style>
    .eu-year > div {
        display: none;
    }
</style>



<div id="EU-selector">
    <p>For EU:</p>
    <div class="dropdown" id="arrowdown">
        <select name="eu-model" id="eu-model">
            <option value="">Select your model:</option>
            <option value="1">Beetle</option>
            <option value="2">Caddy4</option>
            <option value="3">CC</option>
            <option value="4">E-Golf</option>
            <option value="5">Eos</option>
            <option value="6">Golf 7</option>
            <option value="7">Golf Cabrio</option>
            <option value="8">Golf GTI</option>
            <option value="9">Golf R</option>
            <option value="10">Golf Sportsvan</option>
            <option value="11">Golf Variant</option>
            <option value="12">Jetta</option>
            <option value="13">Passat</option>
            <option value="14">Polo</option>
            <option value="15">Scirocco</option>
            <option value="16">Sharan</option>
            <option value="17">T6</option>
            <option value="18">Tiguan</option>
            <option value="19">Touran</option>
        </select>
        <div class="eu-year">
            <div data-value="1">
                <select>
                    <option value="">Select your year of your Beetle:</option>
                    <option value="1">2015</option>
                </select>
            </div>
            <div data-value="2">
                <select>
                    <option value="">Select your year of your Caddy4:</option>
                    <option value="1">2015</option>
                </select>
            </div>
        </div>
    </div>
</div>




<iframe src="https://calendar.google.com/calendar/b/1/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Europe%2FLondon&amp;src=bWFya2dhcmRuZXIyNkBnbWFpbC5jb20&amp;src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;src=ZW4udWsjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%237986CB&amp;color=%2333B679&amp;color=%230B8043&amp;mode=WEEK" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>



<script>
    $(document).ready(function() {
        $('#eu-model').on('change', function() {
            if (this.value.length) {
                $('.eu-year > div').hide();
                $('.eu-year > div[data-value="' + this.value + '"').show();
            }
        });
    })
</script>




