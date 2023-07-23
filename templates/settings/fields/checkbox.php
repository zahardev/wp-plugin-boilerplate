<?php
/**
 * @var string $id
 * @var string $name
 * @var bool $value
 * */
?>
<input type="checkbox" id="<?php echo esc_attr( $id ) ?>" name="<?php echo esc_attr( $name ) ?>" value="1" <?php checked( $value, 1 ); ?> />
