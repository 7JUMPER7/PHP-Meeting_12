<div class="container">
	<form action="/admin/delete" method="POST" name="Countries">
		<div class="header">Countries</div>
		<div class="tableContainer">
			<table class="table table-hover mt-5">
				<thead>
					<tr>
						<th></th>
						<th>Id</th>
						<th>Country</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<input type="text" name="Country" placeholder="Country">
		<div class="buttons">
			<input type="submit" name="sBtn" value="Add" onclick="addCountry(event)">
			<input type="submit" name="delBtn" value="Delete selected" onclick="deleteFromTable(event)">
		</div>
	</form>
</div>
