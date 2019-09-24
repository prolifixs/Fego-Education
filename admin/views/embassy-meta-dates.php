<div class="embassy-dates">

  <label for="embassy_datepicker">Date: </label>
  <input type="text" id="embassy_datepicker" name="embassy_date" value="<?php echo $this->GetMetaOption('embassy_date');?>">
  
  @<input type="text"  name="time_start" id="embassy_start" value="<?php echo $this->GetMetaOption('time_start');?>"><div style="display: inline-block;" > till 
  <input type="text"  name="time_end" id="embassy_end" value="<?php echo $this->GetMetaOption('time_end');?>"></div>
 </div>