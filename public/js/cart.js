$(document).ready(function(){
    $('.btn-plus').click(function(){
        $parents=$(this).parents('tr');
        $price=$parents.find('#price').val();
        $count=$parents.find('#count').val();
        $total=$price*$count;
        $parents.find('#total').html(`${$total} MMK`);
        subTotal();
    })

    $('.btn-minus').click(function(){
        $parents=$(this).parents('tr');
        $price=$parents.find('#price').val();
        $count=$parents.find('#count').val();
        $total=$price*$count;
        $parents.find('#total').html(`${$total} MMK`);
        subTotal();
    })



    function subTotal(){
        $totalPrice=0
        $('#tableData tr').each(function(index,row){
            $totalPrice+=Number($(row).find('#total').html().replace('MMK',''));
        })
        $('#totalPrice').html(`${$totalPrice} MMK`);
        $('#finalPrice').html(`${$totalPrice+3000} MMK`);
    }
})
