/**
 * 
 * Generic functions for automatic calculation for formfields (text input).
 *
 * Example:
 * amcnAddCalculatedField("#fld1",  5.0, "#fld2", 2);
 * amcnAddCalculatedField("#fld3", 10.0, "#fld4", 2);
 * amcnSumFields(["#fld2", "#fld4"], "#sum", 2);
 */

/**
 * Value from input with id idFldAmount is multiplied with factor,
 * the result is stored in field with id idFldSum.
 * Result is displayed with precision no of decimals.
 * The sum is calculated automatically each time the value changes.
 */
function amcnAddCalculatedField(idFldAmount, factor, idFldSum, precision) {

	jQuery(idFldAmount).on("blur keyup", function() {
		var newSum, oldSum = jQuery(idFldSum).val();
		if (!jQuery.isNumeric(jQuery(this).val())) {
			newSum = "";
		}
		else {
			newSum = (jQuery(this).val() * factor).toFixed(precision);
		}

		if (oldSum != newSum) {
			jQuery(idFldSum).val(newSum);
			jQuery(idFldSum).change();
		}
	});
};


/**
 * Calculate the sum of an array of fields, the result is stored in field with id idSum.
 * Result is displayed with precision no of decimals.
 * The sum is automatically recalculated when one of the fieldvalue chages.
 */
function amcnSumFields(idFlds, idSum, precision) {

	jQuery(idSum).change(function() {
		var numVal, sum = 0, oldSum = jQuery(idSum).val();
		jQuery.each(idFlds, function(i, idFld) {
			numVal = jQuery(idFld).val();
			if (jQuery.isNumeric(numVal)) {
				sum += Number(numVal);
			}
		});
		var newSum = sum.toFixed(precision);
		if (oldSum != newSum) {
			jQuery(idSum).val(newSum);
		}
	});

	jQuery.each(idFlds, function(i, idFld) {
		jQuery(idFld).change(function() {
			jQuery(idSum).change();
		});
	});
}
