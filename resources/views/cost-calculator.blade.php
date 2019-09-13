@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
    <div class="inner-banner" style="background-image: url(&quot;{{asset(config('url').'/public/images/website_images/view_our_auction.jpg')}}&quot;);>
         <div class="container">
         <h1>Cost Calculator</h1>
    </div>
    <div class="calculator_form">
        <div class="container">
            <form action="javascript:void(0);" method="post" id="calculatorform" class="calculatorform">
                <table border="1">
                    <tr>
                        <th><b>Vessel/Owner Data</b></th>
                        <th colspan="2"><b>Enter Owner Data Below</b></th>
                    </tr>
                    <tr>
                        <td>Listing price</td>
                        <td colspan="2">
                            <input class="form-control" required type="number" value="3900000"  id="cal_listing_price" name="listing_price">
                        </td>
                    </tr>
                    <tr>
                        <td>Expected sale price (traditional sale)</td>
                        <td colspan="2">
                            <input class="form-control" required type="number" value="3125000" id="cal_expected_sale_price" name="expected_sale_price">
                        </td>
                    </tr>
                    <tr>
                        <td>Annual expense (carry costs) </td>
                        <td colspan="2">
                            <input class="form-control" required type="number" value="10"  id="cal_annual_expense" name="annual_expense"> 
                        </td>
                    </tr>
                    <tr>
                        <td>Annual depreciation </td>
                        <td colspan="2">
                            <input class="form-control" required type="number" value="4" id="cal_annual_depreciation" name="annual_depreciation"> 
                        </td>
                    </tr>
                    <tr>
                        <td>Annual return on invested capital (opportunity cost) </td>
                        <td colspan="2">
                            <input class="form-control" required type="number" value="0" id="cal_annual_return_invested" name="annual_return_invested">
                        </td>
                    </tr>
                    <tr>
                        <td>Annual inflation </td>
                        <td colspan="2">
                            <input class="form-control" required type="number" value="2" id="cal_annual_inflation" name="annual_inflation"> 
                        </td>
                    </tr>
                    <tr>
                        <td>Survey</td>
                        <td colspan="2">
                            <input class="form-control" required type="number" value="5000" id="cal_survey" name="survey">
                        </td>
                    </tr>
                    <tr>
                        <td>Days on market</td>
                        <td colspan="2">
                            <input class="form-control" required type="number" value="365" id="cal_day_of_market" name="day_of_market">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input  type="submit" style="float: right;height: 40px;" name="submit" value="Calculate">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <th><b>Results</b></th>
                        <th><b>Traditional</b></th>
                        <th><b>Auction</b></th>
                    </tr>
                    <tr>
                        <th>Expense (carry costs)</th>
                        <td>
                            <input class="form-control" readonly="true"  type="number" id="t_expense" name="t_expense">
                        </td>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="a_expense" name="a_expense">
                        </td>
                    </tr>
                    <tr>
                        <th>Depreciation</th>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="t_depreciation" name="t_depreciation">
                        </td>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="a_depreciation" name="a_depreciation">
                        </td>
                    </tr>
                    <tr>
                        <th>Opportunity cost of capital tied up</th>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="t_opportunity_cost" name="t_opportunity_cost">
                        </td>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="a_opportunity_cost" name="a_opportunity_cost">
                        </td>
                    </tr>
                    <tr>
                        <th>Inflation</th>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="t_inflation" name="t_inflation">
                        </td>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="a_inflation" name="a_inflation">
                        </td>
                    </tr>
                    <tr>
                        <th>Survey</th>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="t_survey" name="t_survey">
                        </td>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="a_survey" name="a_survey">
                        </td>
                    </tr>
                    <tr>
                        <th>Total Cost of Ownership (TCO)</th>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="t_ownership_total" name="t_ownership_total">
                        </td>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="a_ownership_total" name="a_ownership_total">
                        </td>
                    </tr>
                    <tr>
                        <th>Price reduction from list</th>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="t_reduction" name="t_reduction">
                        </td>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="a_reduction" name="a_reduction">
                        </td>
                    </tr>
                    <tr>
                        <th>Total Costs and Price Reduction</th>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="t_reduction_total" name="t_reduction_total">
                        </td>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="a_reduction_total" name="a_reduction_total">
                        </td>
                    </tr>
                    <tr>
                        <th>Selling Price</th>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="t_selling_price" name="t_selling_price">
                        </td>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="a_selling_price" name="a_selling_price">
                        </td>
                    </tr>
                    <tr>
                        <th><b>Net Proceeds</b></th>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="t_net_proceeds" name="t_net_proceeds">
                        </td>
                        <td>
                            <input class="form-control" readonly="true" type="number" id="a_net_proceeds" name="a_net_proceeds">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

</div>
@include('general.footer')
<script>
    $('#calculatorform').submit(function ()
    {
        var listing_price = document.getElementById("cal_listing_price").value;
        var expected_sale_price = document.getElementById("cal_expected_sale_price").value;
        var annual_expense = document.getElementById("cal_annual_expense").value;
        var annual_depreciation = document.getElementById("cal_annual_depreciation").value;
        var annual_return_invested = document.getElementById("cal_annual_return_invested").value;
        var annual_inflation = document.getElementById("cal_annual_inflation").value;
        var survey = document.getElementById("cal_survey").value;
        var day_of_market = document.getElementById("cal_day_of_market").value;
        if (listing_price != '' && expected_sale_price != '' && annual_expense != '' && annual_depreciation != '' && annual_return_invested != '' && annual_inflation != '' && survey != '' && day_of_market != '')
        {
            //Traditional
            var t_expense = Math.round(((listing_price * (annual_expense / 100)) / 365) * day_of_market);
            var t_depreciation = Math.round(((listing_price * (annual_depreciation / 100)) / 365) * day_of_market);
            var t_opportunity_cost = Math.round(((listing_price * (annual_return_invested / 100)) / 365) * day_of_market);
            var t_inflation = Math.round((1 - (Math.pow((1 - (annual_inflation / 100) / 365), day_of_market))) * (listing_price));
            var t_survey = Math.round(0);
            var t_ownership_total = Math.round(t_expense + t_depreciation + t_opportunity_cost + t_inflation + t_survey);
            var t_selling_price = Math.round(expected_sale_price);
            var t_reduction = Math.round(listing_price - t_selling_price);
            var t_reduction_total = Math.round(t_ownership_total + t_reduction);
            var t_net_proceeds = Math.round(t_selling_price - t_ownership_total);
            document.getElementById("t_expense").value = t_expense;
            document.getElementById("t_depreciation").value = t_depreciation;
            document.getElementById("t_opportunity_cost").value = t_opportunity_cost;
            document.getElementById("t_inflation").value = t_inflation;
            document.getElementById("t_survey").value = t_survey;
            document.getElementById("t_ownership_total").value = t_ownership_total;
            document.getElementById("t_reduction").value = t_reduction;
            document.getElementById("t_reduction_total").value = t_reduction_total;
            document.getElementById("t_selling_price").value = t_selling_price;
            document.getElementById("t_net_proceeds").value = t_net_proceeds;
            //Auction
            var a_expense = Math.round(((listing_price * (annual_expense / 100)) / 365) * 42);
            var a_depreciation = Math.round(((listing_price * (annual_depreciation / 100)) / 365) * 42);
            var a_opportunity_cost = Math.round(((listing_price * (annual_return_invested / 100)) / 365) * 42);
            var a_inflation = Math.round((1 - (Math.pow((1 - (annual_inflation / 100) / 365), 42))) * (listing_price));
            var a_survey = Math.round(survey);
            var a_ownership_total = Math.round(a_expense + a_depreciation + a_opportunity_cost + a_inflation + a_survey);
            var a_reduction_total = Math.round(t_reduction_total);
            var a_reduction = Math.round(a_reduction_total - a_ownership_total);
            var a_selling_price = Math.round(listing_price - a_reduction);
            var a_net_proceeds = Math.round(a_selling_price - a_ownership_total);
            document.getElementById("a_expense").value = a_expense;
            document.getElementById("a_depreciation").value = a_depreciation;
            document.getElementById("a_opportunity_cost").value = a_opportunity_cost;
            document.getElementById("a_inflation").value = a_inflation;
            document.getElementById("a_survey").value = a_survey;
            document.getElementById("a_ownership_total").value = a_ownership_total;
            document.getElementById("a_reduction").value = a_reduction;
            document.getElementById("a_reduction_total").value = a_reduction_total;
            document.getElementById("a_selling_price").value = a_selling_price;
            document.getElementById("a_net_proceeds").value = a_net_proceeds;
        }
    });
</script>
@endsection