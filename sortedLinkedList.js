class Node {
  constructor(value) {
    this.value = value;
    this.next = null;
  }
}

class SortedLinkedList {
  constructor() {
    this.head = null;
    this.type = null; // 'string' or 'number'
  }

  isValidType(value) {
    return typeof value === this.type;
  }

  add(value) {
    if (this.type === null) {
      this.type = typeof value;
    }

    if (!this.isValidType(value)) {
      throw new Error('Invalid value type. The list can only contain values of the same type.');
    }

    const newNode = new Node(value);

    if (!this.head || value < this.head.value) {
      newNode.next = this.head;
      this.head = newNode;
    } else {
      let current = this.head;
      while (current.next && value >= current.next.value) {
        current = current.next;
      }
      newNode.next = current.next;
      current.next = newNode;
    }
  }

  toString() {
    let current = this.head;
    const values = [];

    while (current) {
      values.push(current.value);
      current = current.next;
    }

    return values.join(' -> ');
  }
}

// Example
const sortedLinkedList = new SortedLinkedList();

sortedLinkedList.add(5);
sortedLinkedList.add(2);
sortedLinkedList.add(8);
sortedLinkedList.add(1);

console.log(sortedLinkedList.toString()); // Output: 1 -> 2 -> 5 -> 8

try {
  sortedLinkedList.add('hello'); // Throws an error since it's a different type
} catch (error) {
  console.log(error.message); // Output: Invalid value type. The list can only contain values of the same type.
}

sortedLinkedList.add(3);
console.log(sortedLinkedList.toString()); // Output: 1 -> 2 -> 3 -> 5 -> 8