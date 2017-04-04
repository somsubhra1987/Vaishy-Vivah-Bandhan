function numberFormat(val, decimalPlaces) 
 {
	var multiplier = Math.pow(10, decimalPlaces);
	return (Math.round(val * multiplier) / multiplier).toFixed(decimalPlaces);
 }
 
function updateVolumetricWeight(rowID)
{
	var divID = 'weightRw'+rowID;
	var widthList, lengthlist, heightlist, volWeight; 	
	$('#'+divID+' input[type=text]').each(function(){
		var attrID = ($(this).attr('id'));
		if(attrID == 'ukmbitem-widthlist')
		{
			widthList = this.value;
		}
		else if(attrID == 'ukmbitem-lengthlist')
		{
			lengthlist = this.value;
		}
		else if(attrID == 'ukmbitem-heightlist')
		{
			heightlist = this.value;
		}
		else
		{
			if(attrID == 'ukmbitem-volumetricweightlist')
			{
				volWeight = numberFormat((widthList*lengthlist*heightlist/5000),2);
				if(volWeight>0)
				{
					this.value = volWeight;
				}
			}
		}	
	});	
}