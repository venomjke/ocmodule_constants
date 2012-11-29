<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>

  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $this->language->get('heading_title'); ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $this->language->get('button_save'); ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $this->language->get('button_cancel'); ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" id="form">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $this->language->get('entry_alias'); ?> </td>
            <td><input type="text" name="alias" value="<?php echo $alias; ?>" size="128" />
                <input type="hidden" name="old_alias" value="<?php echo $alias; ?>" />

              <?php if ($error_alias) { ?>
              <span class="error"><?php echo $error_alias; ?></span>
              <?php } ?></td>
            </td>
          <tr>
            <td><span class="required">*</span> <?php echo $this->language->get('entry_title'); ?></td>
            <td><input type="text" name="title" value="<?php echo $title; ?>" size="128" />
              <?php if ($error_title) { ?>
              <span class="error"><?php echo $error_title; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $this->language->get('entry_value'); ?></td>
            <td>
              <textarea name="value" rows="5" cols="100"><?php echo $value; ?></textarea>
              <?php if ($error_value) { ?>
              <span class="error"><?php echo $error_value; ?></span>
              <?php } ?></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div> 
<?php echo $footer; ?>