<!--?php include '../../include/header.php';?-->
<h2>Parameter</h2>
<table class="table">
<thead>
<tr>
<th>Field</th>
<th>Type</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td class="code">api</td>
<td>key</td>
<td>
<p>(Required) Your API Authetification to access your account</p>
</td>
</tr>
<tr>
<td class="code">requestID</td>
<td>Interger</td>
<td>
<p>(Required). A unique code for every transaction</p>
</td>
</tr>
<tr>
<td class="code">serviceID</td>
<td>String</td>
<td>
<p>serviceID (Required).&nbsp;Merchants or Operator ID ( gotv, glo, mtm-data, airtel etc)</p>
</td>
</tr>  

<tr>
<td class="code">plan</td>
<td>String</td>
<td>
<p>The plan Subscribing for (gotv-plus, gotv-value etc)</p>
</td>
</tr>
<tr>
<td class="code">amount</td>
<td>Float</td>
<td>
<p>Amount (Required). Amount paying without Chargers</p>
</td>
</tr>
<tr>
<td class="code">customerID</td>
<td>String</td>
<td>
<p>(e.g Dstv SmartCard Number) (Required).&nbsp;</p>
</td>
</tr>
<tr>
<td class="code">phone</td>
<td>string</td>
<td>
<p>Phone Number (Required without country code).</p>
</td>
</tr>
<tr>
<td class="code">email</td>
<td>String</td>
<td>
<p>&nbsp;Email Address (Optional)</p>
</td>
</tr>
</tbody>
</table>