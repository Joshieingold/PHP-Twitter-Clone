<?php
class User
{
    private string $firstName;
    private string $lastName;
    private string $screenName;
    private string $password;
    private string $confirmPassword;
    private string $address;
    private string $province;
    private string $postalCode;
    private string $location;
    private string $phone;
    private string $email;
    private int $id;

    // empty constructor with meaning :^)
    public function __construct() {}

    /////////////////////////
    // Getters and Setters //
    /////////////////////////

    final public function getId(): string
    {
        return $this->id;
    }
    public function setId(int $value): void
    {
        $this->id = $value;
    }
    final public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function setFirstName(string $value): void
    {
        // Trim it.
        $trimmedName = trim($value);
        if ($trimmedName === '') {
            throw new InvalidArgumentException('First Name cannot be Empty');
        }
        $this->firstName = $trimmedName;
    }

    final public function getLastName(): string
    {
        return $this->lastName;
    }
    public function setLastName(string $value): void
    {
        // Trim it.
        $trimmedName = trim($value);
        if ($trimmedName === '') {
            throw new InvalidArgumentException('Last Name cannot be Empty');
        }
        $this->lastName = $trimmedName;
    }
    final public function getScreenName(): string
    {
        return $this->screenName;
    }
    public function setScreenName(string $value): void
    {
        $trimmedName = trim($value);
        if ($trimmedName === '') {
            throw new InvalidArgumentException('Screen Name cannot be Empty');
        }
        $this->screenName = $trimmedName;
    }
    final public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $value): void
    {
        // DO NOT TRIM IT
        $this->password = $value;
    }
    final public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }
    public function setConfirmPassword(string $value): void
    {
        // DO NOT TRIM IT
        $this->confirmPassword = $value;
    }
    final public function getAddress(): string
    {
        return $this->address;
    }
    public function setAddress(string $value): void
    {
        $trimmedAddress = trim($value);
        $this->address = $trimmedAddress;
    }
    final public function getProvince(): string
    {
        return $this->province;
    }
    public function setProvince(string $value): void
    {
        $trimmedProvince = trim($value);
        if ($trimmedProvince === '') {
            throw new InvalidArgumentException('Province cannot be Empty');
        }
        $this->province = $trimmedProvince;
    }
    final public function getPostalCode(): string
    {
        return $this->postalCode;
    }
    public function setPostalCode(string $value): void
    {
        $postalTrim = trim($value);
        if ($postalTrim !== '' && !preg_match('/^[A-Za-z0-9\s\-]{3,7}$/', $postalTrim)) {
            throw new InvalidArgumentException('Invalid Postal Code format');
        }
        $this->postalCode = strtoupper($postalTrim);
    }
    final public function getLocation(): string
    {
        return $this->location;
    }
    public function setLocation(string $value): void
    {
        // Make sure its not empty
        $trimmedLocation = trim($value);
        if ($trimmedLocation === '') {
            throw new InvalidArgumentException("Location cannot be Empty");
        }
        $this->location = $trimmedLocation;
    }
    final public function getPhone(): string
    {
        return $this->phone;
    }
    public function setPhone(string $value): void
    {
        $phoneTrim = preg_replace('/[\s\-().]/', '', trim($value));
        if ($phoneTrim !== '' && !preg_match('/^\+?\d{7,15}$/', $phoneTrim)) {
            throw new InvalidArgumentException('Invalid Phone Format');
        }
        $this->phone = $phoneTrim;
    }
    final public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $value): void
    {
        // Make sure its not empty
        $trimmedEmail = trim($value);
        if ($trimmedEmail === '') {
            throw new InvalidArgumentException("Email cannot be empty");
        }
        // Make sure it is an email 
        if (!filter_var($trimmedEmail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid Email Format");
        }
        $this->email = $trimmedEmail;
    }
}
