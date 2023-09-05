<div class="row" style="margin-top: 10px;">
  <div class="col-lg-12">
    <div class="form-group ">
      <label for="label">name: </label>
      <input id="name" class="form-control" name="name" type="text" value="<? if(isset($grp)) echo $grp[0]['name']?>" required>
    </div>
    <div class="form-group ">
      <label for="label">description:</label>
      <textarea id="description" class="form-control" name="description"><? if(isset($grp)) echo $grp[0]['description']?>
</textarea>
    </div> 
    <div class="form-group ">
      <label for="label">active: </label>
      <select name="active" <? if(($grp[0]['active'] == 0) and (isset($grp))){echo 'selected';}?> id="active" class="form-control selectpicker">
        <option value="0">no activo</option>
        <option value="1" <? if(($grp[0]['active'] == 1) and (isset($grp))){echo 'selected';}?>>activo</option>
      </select>
    </div>
  </div>
</div>


