
  <form id="connectionform">
	  <div class="mb-3 mt-3">
		<label for="email" class="form-label">snowflake username:</label>
		<input type="text" class="form-control" id="sn-usr" placeholder="Enter username" name="user" required>
	  </div>
	  <div class="mb-3">
		<label for="pwd" class="form-label">snowflake password:</label>
		<input type="password" class="form-control" id="sn-pwd" placeholder="Enter password" name="pswd" required>
	  </div>
	   <div class="form-check mb-3">
		<label class="form-check-label">
		  <input class="form-check-input" type="checkbox" name="remember"> Remember me
		</label>
	  </div>
	  <button type="submit" class="btn btn-primary">Test Connection</button>
	  <!--<button type="submit" class="btn btn-primary" onClick="testConnection()">Test Connection</button>-->
	  <label class="form-check-label" id="test-response"> </label>
	
	</form>