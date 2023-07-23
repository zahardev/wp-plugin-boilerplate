<?php
/**
 * @var string $id
 * @var string $name
 * @var array $options
 * @var array $value
 * */
?>
<select id="<?php echo esc_attr( $id ) ?>" name="<?php echo esc_attr( $name ) ?>">
    <?php foreach ( $options as $id => $option ) : ?>
        <option value="<?php echo esc_attr( $id ) ?>" <?php selected( $value, $id ) ?>>
            <?php echo esc_html( $option ) ?>
        </option>
    <?php endforeach; ?>
</select>
