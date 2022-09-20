<form name="main-form" method="get" id="main-form" onsubmit="submitButtonPressed()">
    <div class="user-input" id="x-input">
        <div class="inputs">
            <p>X</p>
            <input type="radio" id="x-equals--2-radio" name="x-input" value="-2">
            <label for="x-equals--2-input">-2</label><br>
            <input type="radio" id="x-equals--1.5-radio" name="x-input" value="-1.5">
            <label for="x-equals--1.5-input">-1.5</label>
            <input type="radio" id="x-equals--1-radio" name="x-input" value="-1">
            <label for="x-equals--1-input">-1</label><br>
            <input type="radio" id="x-equals--0.5-radio" name="x-input" value="-0.5">
            <label for="x-equals--0.5-input">-0.5</label>
            <input type="radio" id="x-equals-0-radio" name="x-input" value="0">
            <label for="x-equals-0-input">0</label><br>
            <input type="radio" id="x-equals-0.5-radio" name="x-input" value="0.5">
            <label for="x-equals-0.5-input">0,5</label><br>
            <input type="radio" id="x-equals-1-radio" name="x-input" value="1">
            <label for="x-equals-1-input">1</label>
            <input type="radio" id="x-equals-1.5-radio" name="x-input" value="1.5">
            <label for="x-equals-1.5-input">1.5</label>
            <input type="radio" id="x-equals-2-radio" name="x-input" value="2">
            <label for="x-equals-2-input">2</label>
        </div>
        <div class="validation-result" id="x-validation-result">

        </div>

    </div>

    <div class="user-input" id="y-input">
        <div class="inputs">
            <label for="y-text-input">Y</label>
            <input class="y-text-input" type="text" id="y-text-input" name="y-input" value="0">
        </div>
        <div class="validation-result" id="y-validation-result">

        </div>

    </div>

    <div class="user-input" id="r-input">
        <div class="inputs">
            <p>R</p>
            <input class="r-button" type="button" id="r-equals-1" value="1">
            <input class="r-button" type="button" id="r-equals-1.5" value="1.5">
            <input class="r-button" type="button" id="r-equals-2" value="2">
            <input class="r-button" type="button" id="r-equals-2.5" value="2.5">
            <input class="r-button" type="button" id="r-equals-3" value="3">
            <input type="text" id="real-r" name="r-input" style="display: none">
        </div>
        <div class="validation-result" id="r-validation-result">

        </div>

    </div>
    <div class="submit-button">
        <button id="submit-button">Check!</button>
    </div>



    <!-- fake R -->
    <!--
    <input type="text" id="r-text-input" name="r-input">
    <label for="r-text-input">label-for-R</label>
    <button type="submit">SUBMIT BUTTON</button>
    -->


</form>