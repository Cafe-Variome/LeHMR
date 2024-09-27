<?php

/**
 * @author Umar Riaz
 * Created at 16/04/2021
 * 
 */ ?>
<?= $this->section('content') ?>
<div class="row">
<div id="schema"></div>
</div>

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script>


// var element = $("#json");
// element.html(JSON.stringify(data, undefined, 2));
// console.log(element)
// element.textContent = JSON.stringify(data, undefined, 2);
window.onload = function () {
    var data ={
		"$schema": "https://raw.githubusercontent.com/ga4gh-beacon/beacon-v2/main/framework/json/responses/beaconFilteringTermsResponse.json",
		"meta": {
			"beaconId": "uk.ac.le.lehmr.beacon",
			"apiVersion": "v2.0",
			"returnedGranularity": "record",
			"receivedRequestSummary": {
				"apiVersion": "v2.0",
				"requestedSchemas": [],
				"filters": [],
				"requestParameters": {},
				"includeResultsetResponses": "HIT",
				"pagination": {
					"skip": 0,
					"limit": 10
				},
				"requestedGranularity": "record"
			},
			"returnedSchemas": []
		},
		"response": {
			"resources": [],
			"filteringTerms": [
				{
					"type": "alphanumeric",
					"id": "title"
				},
				{
					"type": "alphanumeric",
					"id": "abstract"
				},
				{
					"type": "alphanumeric",
					"id": "keywords"
				},
				{
					"type": "alphanumeric",
					"id": "researchProjects"
				},
				{
					"type": "alphanumeric",
					"id": "accessRights"
				},
				{
					"type": "alphanumeric",
					"id": "organisations"
				},
				{
					"type": "alphanumeric",
					"id": "contactPoints"
				},
				{
					"type": "alphanumeric",
					"id": "dataControllers"
				},
				{
					"type": "alphanumeric",
					"id": "legalJurisdictions"
				},
				{
					"type": "alphanumeric",
					"id": "dataTypes"
				},
				{
					"type": "numeric",
					"id": "studySize"
				},
				{
					"type": "numeric",
					"id": "ageRange"
				}
			]
		},
		"info": {}
	};
    var j = JSON.stringify(data, undefined, 2);
    document.getElementById('schema').innerHTML = `<pre><code>${j}</code></pre>`
    // var element = $("#schema");
    // 
    // element.i
}




</script>

