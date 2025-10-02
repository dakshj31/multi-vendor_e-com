$(document).ready(function (){

    // Handle filter checkboxes (colors,sizes,etc)
    $(document).on('change', '.filterAjax', function () {
        RefreshFilters("yes");
    });

    // Handle sort dropdown
    $(document).on('change', '.getsort', function () {
        RefreshFilters("yes");
    });

    // Price range filter (if you add min-max inputs later)
    $(document).on('click', '#pricesort', function() {
        var minprice = parseInt($('#from_range').val());
        var maxprice = parseInt($('#to_range').val());
        queryStringObject["price"] = [minprice + "-" +maxprice];
        if(minprice == "" && maxprice == "") {
            delete queryStringObject["price"];
        }
        $("#priceRange").val(minprice + "-" + maxprice);

        debounce(function () {
            $("input[name='price']").val($("#priceRange").val()).click();
        }, 100)();
        RefreshFilters("yes");
    });
});

    // Build queryand call Ajax
    function RefreshFilters(type) {
        var queryStringObject = {};

        // Collect checked filters
        $(".filterAjax").each(function () {
            var name = $(this).attr('name');
            queryStringObject[name] = [];
            $.each($("input[name='" + name +"']:checked"), function() {
                queryStringObject[name].push($(this).val());
            });
            if (queryStringObject[name].length == 0) {
                delete queryStringObject[name];
            }
        });

        // Sort dropdown
        var value = $('.getsort').val();
        var name = $('.getsort').attr('name');
        if (value) {
            queryStringObject[name] = [value];
        } else {
            delete queryStringObject[name];
        }

        if (type === "yes") {
            filterproducts(queryStringObject);
        } else {
            filterproducts({});
        }
    }

    // Ajax call for filtered products
    function filterproducts(queryStringObject) {
        $('body').css({'overflow' : 'hidden'});

        let queryString = "";
        for (var key in queryStringObject) {
            if (queryString == '') {
                queryString += "?" + key + "=";
            } else {
                queryString += "&" + key + "=";
            }
            var queryValue = queryStringObject[key].join("~");
            queryString += queryValue;
        }

        if (history.pushState) {
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + queryString;
            newurl = newurl.replace("&undefined=undefined", "");
            window.history.pushState({path: newurl }, '', newurl);
        }

        if (newurl.indexOf("?") >= 0) {
            newurl = newurl + "&json=";
        } else {
            newurl = newurl + "?json";
        }

        $.ajax({
            url: newurl,
            type: 'get',
            dataType: 'json',
            success: function (resp) {
                $("#appendProducts").html(resp.view);
                document.body.style.overflow = 'scroll';
            },
            error: function () { } 
        });
    }