<?php
    include_once "./include/views/_header.php";
?>

<div class="left-field" id="left-field">
    <container id="create-event">
        <header>
            <h2>Create new event</h2>
        </header>

        <form class="form" id="create-event-form" name="create-event-form" onsubmit="" action="create_event_process.php" method="post">

            <div class="form-control">
            <label>Event name</label><p id="required">*</p>
            <input type="text" placeholder="event name" name="evt_name" id="evt_name">
            <small>Error message</small>
            </div>

            <div class="form-control">
            <label>Describe your event</label><p id="required">*</p>
            <textarea placeholder="belching contest, backyard fish sale, beard seminar..." name="evt_text" id="evt_text" maxlength="1000"></textarea>
            <small>Error message</small>
            </div>

            <div class="form-control">
            <label>Start date</label><p id="required">*</p>
            <input type="date" name="evt_sdate" id="evt_sdate" min="<?=date("Y-m-d")?>">
            <small>Error message</small>
            </div>

            <div class="form-control">
            <label>Start time</label><p id="required">*</p>
            <input type="time" name="evt_stime" id="evt_stime">
            <small>Error message</small>
            </div>

            <div class="form-control">
            <label>End date</label>
            <input type="date" name="evt_edate" id="evt_edate" min="<?=date("Y-m-d")?>">
            <small>Error message</small>
            </div>

            <div class="form-control">
            <label>End time</label>
            <input type="time" name="evt_etime" id="evt_etime">
            <small>Error message</small>
            </div>

            <div class="form-control">
            <label>Adress</label>
            <input type="text" placeholder="Partystreet 123" name="evt_adress" id="evt_adress">
            <small>Error message</small>
            </div>

            <div class="form-control">
            <label>Zip</label>
            <input type="text" placeholder="123 45" name="evt_zip" id="evt_zip" maxlength="5">
            <small>Error message</small>
            </div>

            <div class="form-control">
            <label>City</label>
            <input type="text" placeholder="Kicksville" name="evt_city" id="evt_citys">
            <small>Error message</small>
            </div>

            <div class="form-control">
            <label>Price</label>
            <input type="number" placeholder="100" name="evt_price" id="evt_price">
            <small>Error message</small>
            </div>

        </form>
    </container>
</div>


<?php
    include_once "./include/views/_footer.php";
?>