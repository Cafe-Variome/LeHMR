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
	"$schema": "http://json-schema.org/draft-07/schema",
	"title": "LeHMR dataset",
	"$comment": "LeHMR dataset model",
	"description": "Schema for a LeHMR dataset entry.",
	"type": "object",
	"required": ["id", "title", "abstract", "keywords", "researchProject", "accessRights", "organisations", "contactPoints", "dataControllers"],
	"properties": {
		"id": {
			"description": "Unique identifier of the dataset",
			"type": "string",
			"examples": ["dataset01"]
		},
		"title": {
			"description": "Title of the dataset",
			"type": "string",
			"examples": ["Cardiovascular events in over 70s"]
		},
		"abstract": {
			"description": "Brief description of the dataset",
			"type": "string",
			"examples": ["Project for inferring relationships between cardiovascular events and age"]
		},
		"keywords": {
			"description": "A list of keywords which define the dataset",
			"type": "array",
			"items": {
				"description": "single keyword",
				"type": "string",
				"examples": ["cardiovascular"]
			},
			"examples": [["cardiovascular", "age"]]
		},
		"researchProjects": {
			"description": "Name(s) of the research project(s) which produced the data",
			"type": "array",
			"items": {
				"description": "Research project name",
				"type": "string",
				"examples": ["Influence of age on cardiovascular events"]
			},
			"examples": [
				["Influence of age on cardiovascular events", "sedentary vs non-sedentary lifestyle effects on cardiovascular events"]
			]
		},
		"accessRights": {
			"description": "URL where the data access request process and/or guidance is provided",
			"type": "string",
			"examples": ["www.access-rights.org"]
		},
		"organisations": {
			"description": "Organisation(s) responsible for the processing of data access requests made to this dataset",
			"type": "array",
			"items": {
				"description": "Organisation responsible for the processing of data access requests made to this dataset",
				"type": "string",
				"examples": ["University of Leicester"]
			},
			"examples": [["University of Leicester", "University Hospitals of Leicester"]]
		},
		"contactPoints": {
			"description": "contact email address(es) for this dataset",
			"type": "array",
			"items": {
				"description": "contact email address",
				"type": "string",
				"examples": ["contact@le.ac.uk"]
			},
			"examples": [["contact@le.ac.uk", "contact@uhl.uk"]]
		},
		"dataControllers": {
			"description": "Organisation(s) which acts as the data controller for this dataset (can be different to the organisation field)",
			"type": "array",
			"items": {
				"description": "Organisation which acts as the data controller for this dataset)",
				"examples": ["University of Leicester"]
			},
			"examples": [["University of Leicester", "University Hospitals of Leicester"]]
		},
		"legalJurisdictions": {
			"description": "A list of the Countries under whose laws the data subjects are collected, processed and stored",
			"type": "array",
			"items": {
				"type": "string"
			},
			"examples": [["United Kingdom (UK)", "Albania", "Andorra"]]
		},
		"dataTypes": {
			"description": "A list of dataTypes collected as part of this dataset",
			"type": "array",
			"items": {
				"type": "string"
			},
			"examples": [["Metabolomics", "Microbiomics", "Proteomics"]]
		},
		"studySize": {
			"description": "The number of subjects/records within the study",
			"type": "integer",
			"example": "7300"
		},
		"ageRange": {
			"description": "Age range of participants within the study",
			"type": "array",
			"items": {
				"type": "integer",
				"minItems": 1,
				"maxItems": 2
			},
			"examples": [[0, 100], [70], [70, 70]]
		}
	},
	"additionalProperties": true
};
    var j = JSON.stringify(data, undefined, 2);
    document.getElementById('schema').innerHTML = `<pre><code>${j}</code></pre>`
    // var element = $("#schema");
    // 
    // element.i
}




</script>

