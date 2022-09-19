<form name="main-form" method="get" onsubmit="submitMainForm()" id="main-form">
    <div class="user-input" id="x-input">
        <div class="inputs">
            <p>X</p>
            <input type="radio" id="x-equals-0.5-radio" name="x-input" value="0.5">
            <label for="x-equals-0.5-input">0,5</label><br>
            <input type="radio" id="x-equals-1-radio" name="x-input" value="1">
            <label for="x-equals-1-input">1</label>
        </div>
        <div class="validation-result" id="x-validation-result">

        </div>

    </div>

    <div class="user-input" id="y-input">
        <div class="inputs">
            <p>Y</p>
            <input type="text" id="y-text-input" name="y-input">
            <label for="y-text-input">label-for-Y</label>
        </div>
        <div class="validation-result" id="y-validation-result">

        </div>

    </div>

    <div class="user-input" id="r-input">
        <div class="inputs">
            <p>R</p>
            <input class="r-button" type="button" id="r-equals-0.5" value="0.5">
            <label for="r-equals-0.5-input">0,5</label><br>
            <input class="r-button" type="button" id="r-equals-1" value="1">
            <label for="r-equals-1-input">1</label>
            <input type="text" id="real-r" name="r-input" style="display: none">
        </div>
        <div class="validation-result" id="r-validation-result">

        </div>

    </div>
    <button type="submit">SUBMIT BUTTON</button>


    <!-- fake R -->
    <!--
    <input type="text" id="r-text-input" name="r-input">
    <label for="r-text-input">label-for-R</label>
    <button type="submit">SUBMIT BUTTON</button>
    -->


</form>