<div class="container">
<?php $err = $errors->toArray();
if(Session::has('error')) $err[] = ['other' => Session::get('error')];
if (!empty($err)):
?>
<strong class="alert alert-danger" style="display:block;min-height:25px;">
    <button style="background-color: white; border-color:brown;float:right; cursor:pointer" onclick="closeAlert()"> ×
    </button>
    <?php foreach ($err as $er):?>
    <?php echo implode(',', $er); ?>
    <?php endforeach;?>
</strong>
<?php endif;?>

@if (Session::has('success'))
    <strong class="alert alert-success" style="display:block;min-height:25px;">
        <button style="background-color: white; border-color:darkgreen;float:right; cursor:pointer"
            onclick="closeAlert()"> ×
        </button>
        {{ Session::get('success') }}
    </strong>
@endif
</div>