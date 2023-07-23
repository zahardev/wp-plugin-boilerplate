<?php
/**
 * @var string $url
 * @var string $id
 * @var string $title
 * @var string $classes
 * @var string $text
 * */
?>

<a id="<?php echo esc_attr( $id ) ?>" href="<?php echo esc_attr( $url ) ?>" class="<?php echo esc_attr( $classes ) ?>"><?php echo esc_html( $text ) ?></a>
