class Node {
    public $value;
    public $next;

    public function __construct($value) {
        $this->value = $value;
        $this->next = null;
    }
}

class SortedLinkedList {
    private $head;
    private $type; // 'string' or 'integer'

    public function __construct() {
        $this->head = null;
        $this->type = null;
    }

    private function isValidType($value) {
        return is_null($this->type) || gettype($value) === $this->type;
    }

    public function add($value) {
        if (!$this->isValidType($value)) {
            throw new Exception('Invalid value type. The list can only contain values of the same type.');
        }

        if ($this->type === null) {
            $this->type = gettype($value);
        }

        $newNode = new Node($value);

        if (!$this->head || $value < $this->head->value) {
            $newNode->next = $this->head;
            $this->head = $newNode;
        } else {
            $current = $this->head;
            while ($current->next && $value >= $current->next->value) {
                $current = $current->next;
            }
            $newNode->next = $current->next;
            $current->next = $newNode;
        }
    }

    public function toString() {
        $current = $this->head;
        $values = [];

        while ($current) {
            $values[] = $current->value;
            $current = $current->next;
        }

        return implode(' -> ', $values);
    }
}

// Example:
$sortedLinkedList = new SortedLinkedList();

$sortedLinkedList->add(5);
$sortedLinkedList->add(2);
$sortedLinkedList->add(8);
$sortedLinkedList->add(1);

echo $sortedLinkedList->toString() . PHP_EOL; // Output: 1 -> 2 -> 5 -> 8

try {
    $sortedLinkedList->add('hello'); // Throws an error since it's a different type
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL; // Output: Invalid value type. The list can only contain values of the same type.
}

$sortedLinkedList->add(3);
echo $sortedLinkedList->toString() . PHP_EOL; // Output: 1 -> 2 -> 3 -> 5 -> 8