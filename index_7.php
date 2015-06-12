<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
    $(function(){
        $.fn.myValidator = function() {
            this.bind('blur', function(){
                var type = $(this).attr('validate');
                var message = $(this).attr('validate-message');
                var pattern = /^.*$/;

                if (type == 'digits'){
                    pattern = /^\d*$/;
                }

                if (type == 'email'){
                    pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.[a-z]{2,6}$/i;
                }

                if (type.search('length-max') != -1){
                    count =  /[0-9]*$/.exec(type);
                    pattern = new RegExp("^.{1,"+count+"}$");
                }

//                console.log(pattern.test($(this).val()));
                if ( pattern.test($(this).val()) == false) {
                    $(this).parent().find('span').remove();
                    $(this).parent().append('<span class="error">'+message+'</span>');
                } else {
                    $(this).parent().find('span').remove();
                }
            });
        };

        $('input, textarea').myValidator();
    });

</script>
<style>
    .error {
        color: red;
    }
</style>
<div>
    <input id="first" type="text" validate='digits' validate-message='Digits only'>
</div>
<div>
    <input id="second" type="text" validate='email' validate-message='Invalid email'>
</div>
<div>
    <textarea validate='length-max-10' validate-message='Max 10 symbols'></textarea>
</div>
<div>
    <input type="text" validate='digits' validate-message='Digits only'>
</div>