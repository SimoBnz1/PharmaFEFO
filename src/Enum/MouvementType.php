// src/Enum/MovementType.php
<?php
            class MovementType {
    const ENTREE = 'ENTREE';
    const SORTIE = 'SORTIE';

    public $value;

    public function __construct(string $value) {
        $this->value = $value;
    }

    public static function from(string $value): self {
        return new self($value);
    }
}