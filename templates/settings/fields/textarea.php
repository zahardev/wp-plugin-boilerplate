<?php
/**
 * @var string $id
 * @var string $classes
 * @var string $name
 * @var string $value
 * @var string $title
 * @var string $description
 * @var string $rows
 * @var string $cols
 * */
?>
<textarea id="<?php echo esc_attr( $id ) ?>" class="<?php echo esc_attr( $classes ) ?>" name="<?php echo esc_attr( $name ) ?>"
          rows="<?php echo esc_attr( $rows ) ?>" cols="<?php echo esc_attr( $cols ) ?>">
<?php echo esc_textarea( $value ) ?>
</textarea>
<br>
<label for="<?php echo esc_attr( $id ) ?>"><?php echo esc_html( $description ) ?></label>
