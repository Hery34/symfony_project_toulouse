<?php 

namespace App\Entity;

use App\Repository\NewsletterRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity (repositoryClass: NewsletterRepository::class)]
class Newsletter {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;
    #[ORM\Column]
    private string $name;
    #[ORM\Column(type :"text")]
    private string $content;
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'newsletters')]
    #[ORM\JoinTable(name: 'user_newsletter')]
    private Collection $users;

    public function __construct() {
        $this->users = new ArrayCollection();

    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getContent(): string {
        return $this->content;
    }
    public function getUsers(): Collection {
        return $this->users;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }
    public function setUsers(Collection $users): void {
        $this->users = $users;
    }

    public function addUser(User $user): void {
        if ($this->users->contains($user)) {
            return;
        }
        $this->users->add($user);
    }
    public function removeUser(User $user): void {
        if (!$this->users->contains($user)) {
            return;
        }
        $this->users->removeElement($user);
    }
}
