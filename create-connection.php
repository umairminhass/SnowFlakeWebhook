<!-- The Modal -->
<div class="modal" id="connModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create Connection</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="container mt-1">
			<!-- Nav Tabs -->
			<ul class="nav nav-tabs" id="myTabs">
				<li class="nav-item">
					<a class="nav-link active" data-bs-toggle="tab" href="#tab1">Snowflake Connection</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tab2">Hubspot Connection</a>
				</li>
			</ul> 
			<!-- Tab Content -->
			<div class="tab-content mt-3">
				<div id="tab1" class="container tab-pane active">
					<?php include "snowflake.php"; ?>
				</div>
				<div id="tab2" class="container tab-pane fade">
					<?php include "hubspot.php"; ?>
				</div>
			</div>

		</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
