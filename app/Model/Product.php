<?php

namespace App\Model;


use Exception;

class Product
{
    /**
     * @param array $product
     * @throws Exception
     */
    public function __construct(array $product = [])
    {
        //print_r(get_class_vars(get_class($this)));
        if(!empty($product)){
            foreach (get_class_vars(get_class($this)) as $var => $val){
                $method = 'set'.ucfirst($var);

                if(!method_exists($this, $method)){
                    throw new Exception('Method not found in Product Class.', 422);
                }
                $this->$method($product[$var]);
            }
        }
    }

    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $category;

    /**
     * @var float
     */
    private float $price;

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return number_format($this->price, 2);
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param float $price
     * @return void
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param string $category
     * @return void
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'category' => $this->getCategory(),
        ];
    }
}
