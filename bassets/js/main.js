var QtyInput = (function () {
	var $qtyInputs = $(".qty-input");

	if (!$qtyInputs.length) {
		return;
	}

	var $inputs = $qtyInputs.find(".product-qty");
	var $countBtn = $qtyInputs.find(".qty-count");
	var qtyMin = parseInt($inputs.attr("min"));
	var qtyMax = parseInt($inputs.attr("max"));

	$inputs.change(function () {
		var $this = $(this);
		var $minusBtn = $this.siblings(".qty-count--minus");
		var $addBtn = $this.siblings(".qty-count--add");
		var qty = parseInt($this.val());

		if (isNaN(qty) || qty <= qtyMin) {
			$this.val(qtyMin);
			$minusBtn.attr("disabled", true);
		} else {
			$minusBtn.attr("disabled", false);
			
			if(qty >= qtyMax){
				$this.val(qtyMax);
				$addBtn.attr('disabled', true);
			} else {
				$this.val(qty);
				$addBtn.attr('disabled', false);
			}
		}
	});

	$countBtn.click(function () {
		var operator = this.dataset.action;
		var $this = $(this);
		var $input = $this.siblings(".product-qty");
		var qty = parseInt($input.val());

		if (operator == "add") {
			qty += 1;
			if (qty >= qtyMin + 1) {
				$this.siblings(".qty-count--minus").attr("disabled", false);
			}

			if (qty >= qtyMax) {
				$this.attr("disabled", true);
			}
		} else {
			qty = qty <= qtyMin ? qtyMin : (qty -= 1);
			
			if (qty == qtyMin) {
				$this.attr("disabled", true);
			}

			if (qty < qtyMax) {
				$this.siblings(".qty-count--add").attr("disabled", false);
			}
		}

		$input.val(qty);
	});
})();


// Clone | Add | Delete | Div
$('#counter').click(function() {
  $('.count').html(function(i, val) { return val*1+1 });
});

/* 1 Category Form */
var row1 = $(".attr1");

function addRow1() {
  row1.clone(true, true).appendTo("#attributes1");
}

function removeRow1(button) {
  button.closest("div.attr1").remove();
}

$('#attributes1 .attr1:first-child').find('.remove1').hide();

/* Doc ready */
$(".add1").on('click', function () {
  addRow1();  
  if($("#attributes1 .attr1").length > 1) {
    //alert("Can't remove row.");
    $(".remove1").show();
  }
});
$(".remove1").on('click', function () {
  if($("#attributes1 .attr1").size() == 1) {
    //alert("Can't remove row.");
    $(".remove1").hide();
  } else {
    removeRow1($(this));
    
    if($("#attributes1 .attr1").size() == 1) {
        $(".remove1").hide();
    }
    
  }
});
// End


/* 2 Category Form */
var row2 = $(".attr2");

function addRow2() {
  row2.clone(true, true).appendTo("#attributes2");
}

function removeRow2(button) {
  button.closest("div.attr2").remove();
}

$('#attributes2 .attr2:first-child').find('.remove2').hide();

/* Doc ready */
$(".add2").on('click', function () {
  addRow2();  
  if($("#attributes2 .attr2").length > 1) {
    //alert("Can't remove row.");
    $(".remove2").show();
  }
});
$(".remove2").on('click', function () {
  if($("#attributes2 .attr2").size() == 1) {
    //alert("Can't remove row.");
    $(".remove2").hide();
  } else {
    removeRow2($(this));
    
    if($("#attributes2 .attr2").size() == 1) {
        $(".remove2").hide();
    }
    
  }
});

// End

/* 22 Category Form */
var row22 = $(".attr22");

function addRow22() {
  row22.clone(true, true).appendTo("#attributes22");
}

function removeRow22(button) {
  button.closest("div.attr22").remove();
}

$('#attributes22 .attr22:first-child').find('.remove22').hide();

/* Doc ready */
$(".add22").on('click', function () {
  addRow22();  
  if($("#attributes22 .attr22").length > 1) {
    //alert("Can't remove row.");
    $(".remove22").show();
  }
});
$(".remove22").on('click', function () {
  if($("#attributes22 .attr22").size() == 1) {
    //alert("Can't remove row.");
    $(".remove22").hide();
  } else {
    removeRow22($(this));
    
    if($("#attributes22 .attr22").size() == 1) {
        $(".remove22").hide();
    }
    
  }
});

// End


/* 44 Category Form */
var row44 = $(".attr44");

function addRow44() {
  row44.clone(true, true).appendTo("#attributes44");
}

function removeRow44(button) {
  button.closest("div.attr44").remove();
}

$('#attributes44 .attr44:first-child').find('.remove44').hide();

/* Doc ready */
$(".add44").on('click', function () {
  addRow44();  
  if($("#attributes44 .attr44").length > 1) {
    //alert("Can't remove row.");
    $(".remove44").show();
  }
});
$(".remove44").on('click', function () {
  if($("#attributes44 .attr44").size() == 1) {
    //alert("Can't remove row.");
    $(".remove44").hide();
  } else {
    removeRow44($(this));
    
    if($("#attributes44 .attr44").size() == 1) {
        $(".remove44").hide();
    }
    
  }
});

// End

/* 3 Category Form */
var row3 = $(".attr3");

function addRow3() {
  row3.clone(true, true).appendTo("#attributes3");
}

function removeRow3(button) {
  button.closest("div.attr3").remove();
}

$('#attributes3 .attr3:first-child').find('.remove3').hide();

/* Doc ready */
$(".add3").on('click', function () {
  addRow3();  
  if($("#attributes3 .attr3").length > 1) {
    //alert("Can't remove row.");
    $(".remove3").show();
  }
});
$(".remove3").on('click', function () {
  if($("#attributes3 .attr3").size() == 1) {
    //alert("Can't remove row.");
    $(".remove3").hide();
  } else {
    removeRow3($(this));
    
    if($("#attributes3 .attr3").size() == 1) {
        $(".remove3").hide();
    }
    
  }
});

// End

/* 4 Category Form */
var row4 = $(".attr4");

function addRow4() {
  row4.clone(true, true).appendTo("#attributes4");
}

function removeRow4(button) {
  button.closest("div.attr4").remove();
}

$('#attributes4 .attr4:first-child').find('.remove4').hide();

/* Doc ready */
$(".add4").on('click', function () {
  addRow4();  
  if($("#attributes4 .attr4").length > 1) {
    //alert("Can't remove row.");
    $(".remove4").show();
  }
});
$(".remove4").on('click', function () {
  if($("#attributes4 .attr4").size() == 1) {
    //alert("Can't remove row.");
    $(".remove4").hide();
  } else {
    removeRow4($(this));
    
    if($("#attributes4 .attr4").size() == 1) {
        $(".remove4").hide();
    }
    
  }
});

// End

/* 5 Category Form */
var row5 = $(".attr5");

function addRow5() {
  row5.clone(true, true).appendTo("#attributes5");
}

function removeRow5(button) {
  button.closest("div.attr5").remove();
}

$('#attributes5 .attr5:first-child').find('.remove5').hide();

/* Doc ready */
$(".add5").on('click', function () {
  addRow5();  
  if($("#attributes5 .attr5").length > 1) {
    //alert("Can't remove row.");
    $(".remove5").show();
  }
});
$(".remove5").on('click', function () {
  if($("#attributes5 .attr5").size() == 1) {
    //alert("Can't remove row.");
    $(".remove5").hide();
  } else {
    removeRow5($(this));
    
    if($("#attributes5 .attr5").size() == 1) {
        $(".remove5").hide();
    }
    
  }
});

// End

/* 6 Category Form */
var row6 = $(".attr6");

function addRow6() {
  row6.clone(true, true).appendTo("#attributes6");
}

function removeRow6(button) {
  button.closest("div.attr6").remove();
}

$('#attributes6 .attr6:first-child').find('.remove6').hide();

/* Doc ready */
$(".add6").on('click', function () {
  addRow6();  
  if($("#attributes6 .attr6").length > 1) {
    //alert("Can't remove row.");
    $(".remove6").show();
  }
});
$(".remove6").on('click', function () {
  if($("#attributes6 .attr6").size() == 1) {
    //alert("Can't remove row.");
    $(".remove6").hide();
  } else {
    removeRow6($(this));
    
    if($("#attributes6 .attr6").size() == 1) {
        $(".remove6").hide();
    }
    
  }
});

// End

// Wizard Form

$(document).ready(function(){
    
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;
  
  $(".next").click(function(){
      
      current_fs = $(this).parent();
      next_fs = $(this).parent().next();
      
      //Add Class Active
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
      
      //show the next fieldset
      next_fs.show(); 
      //hide the current fieldset with style
      current_fs.animate({opacity: 0}, {
          step: function(now) {
              // for making fielset appear animation
              opacity = 1 - now;
  
              current_fs.css({
                  'display': 'none',
                  'position': 'relative'
              });
              next_fs.css({'opacity': opacity});
          }, 
          duration: 600
      });
  });
  
  $(".previous").click(function(){
      
      current_fs = $(this).parent();
      previous_fs = $(this).parent().prev();
      
      //Remove class active
      $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
      
      //show the previous fieldset
      previous_fs.show();
  
      //hide the current fieldset with style
      current_fs.animate({opacity: 0}, {
          step: function(now) {
              // for making fielset appear animation
              opacity = 1 - now;
  
              current_fs.css({
                  'display': 'none',
                  'position': 'relative'
              });
              previous_fs.css({'opacity': opacity});
          }, 
          duration: 600
      });
  });
  
  $('.radio-group .radio').click(function(){
      $(this).parent().find('.radio').removeClass('selected');
      $(this).addClass('selected');
  });
  
  $(".submit").click(function(){
      return false;
  })
      
  });