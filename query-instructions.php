<!-- The Modal -->
<div class="modal" id="instrModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Snowflake Query Instructions</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="container mt-1">
			<p>When interacting with HubSpot's API, it's essential to use the correct internal names (keynames) for contact properties. These internal names are often in lowercase, with words separated by underscores, and may differ from the labels you see in the HubSpot user interface. Here's a list of common default contact properties along with their corresponding internal names:​</p>
			<p>Additionally, if you're working with custom properties, you can retrieve their internal names using HubSpot's Properties API. This API allows you to list all properties for a given object (e.g., contacts) and provides details such as internal names, labels, and types. More information on using the Properties API can be found in HubSpot's developer documentation. By utilizing the correct internal names, you can ensure accurate data management and integration when making API calls to HubSpot.​</p>
			<h2>HubSpot Contact Properties</h2>
			<table class=mt-1">
				<thead>
					<tr>
						<th>Property Label</th>
						<th>Internal Name (API Keyname)</th>
					</tr>
				</thead>
				<tbody>
					<tr><td>First Name</td><td>firstname</td></tr>
					<tr><td>Last Name</td><td>lastname</td></tr>
					<tr><td>Email</td><td>email</td></tr>
					<tr><td>Job Title</td><td>jobtitle</td></tr>
					<tr><td>Phone Number</td><td>phone</td></tr>
					<tr><td>Mobile Phone Number</td><td>mobilephone</td></tr>
					<tr><td>Fax Number</td><td>fax</td></tr>
					<tr><td>Address</td><td>address</td></tr>
					<tr><td>City</td><td>city</td></tr>
					<tr><td>State/Region</td><td>state</td></tr>
					<tr><td>Postal Code</td><td>zip</td></tr>
					<tr><td>Country/Region</td><td>country</td></tr>
					<tr><td>Company Name</td><td>company</td></tr>
					<tr><td>Industry</td><td>industry</td></tr>
					<tr><td>Lifecycle Stage</td><td>lifecyclestage</td></tr>
					<tr><td>Lead Status</td><td>hs_lead_status</td></tr>
					<tr><td>Contact Owner</td><td>hubspot_owner_id</td></tr>
					<tr><td>Create Date</td><td>createdate</td></tr>
					<tr><td>Last Modified Date</td><td>hs_lastmodifieddate</td></tr>
					<tr><td>Last Activity Date</td><td>hs_last_activity_date</td></tr>
					<tr><td>Last Contacted</td><td>hs_last_contacted</td></tr>
					<tr><td>First Page Seen</td><td>hs_analytics_first_url</td></tr>
					<tr><td>Average Page Views</td><td>num_page_views</td></tr>
					<tr><td>HubSpot Score</td><td>hs_lead_score</td></tr>
					<tr><td>Likelihood to Close</td><td>hs_predictivecontactscore</td></tr>
					<tr><td>Marketing Contact Status</td><td>hs_marketable_status</td></tr>
				</tbody>
			</table>

		</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
