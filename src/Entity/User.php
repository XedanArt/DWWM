<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity('email', message: 'Ce mail est déjà associé à un compte.')]
#[UniqueEntity('username', message: 'Ce pseudo existe déjà. Veuillez en choisir un autre.')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: 'L’email est obligatoire.')]
    #[Assert\Email(message: 'Format d’email invalide.')]
    private ?string $email = null;

    #[ORM\Column(length: 50, unique: true)]
    #[Assert\NotBlank(message: 'Le pseudo est obligatoire.')]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Le pseudo doit contenir au moins {{ limit }} caractères.',
        maxMessage: 'Le pseudo ne peut pas dépasser {{ limit }} caractères.'
    )]
    private ?string $username = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\Length(
        max: 400,
        maxMessage: 'La biographie ne peut pas dépasser {{ limit }} caractères.'
    )]
    private ?string $bio = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $lastLogin = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $lastPasswordRequestAt = null;

    #[Assert\NotBlank(message: 'Le mot de passe est obligatoire.')]
    #[Assert\Length(
        min: 8,
        max: 64,
        minMessage: 'Le mot de passe doit contenir au moins {{ limit }} caractères.'
    )]
    #[Assert\Regex(
        pattern: '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/',
        message: 'Le mot de passe doit contenir une majuscule, une minuscule, un chiffre et un caractère spécial.'
    )]
    private ?string $plainPassword = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Topic::class, orphanRemoval: true)]
    private Collection $topics;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Post::class, orphanRemoval: true)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Announcement::class)]
    private Collection $announcements;

    #[ORM\ManyToMany(targetEntity: Topic::class)]
    private Collection $favoriteTopics;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private ?string $resetToken = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $tokenExpiresAt = null;

    public function __construct()
    {
        $this->topics = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->announcements = new ArrayCollection();
        $this->favoriteTopics = new ArrayCollection();
        $this->avatar = 'default-avatar.png';
    }

    public function getId(): ?int { return $this->id; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }

    public function getUsername(): ?string { return $this->username; }
    public function setUsername(string $username): self { $this->username = $username; return $this; }

    public function getRoles(): array
    {
        $roles = $this->roles;
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }
        return array_unique($roles);
    }

    public function setRoles(array $roles): self { $this->roles = $roles; return $this; }

    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): self { $this->password = $password; return $this; }

    public function getAvatar(): ?string { return $this->avatar; }
    public function setAvatar(?string $avatar): self { $this->avatar = $avatar; return $this; }

    public function getBio(): ?string { return $this->bio; }
    public function setBio(?string $bio): self { $this->bio = $bio; return $this; }

    public function getUserIdentifier(): string { return $this->email; }
    public function eraseCredentials(): void {}

    public function isAdmin(): bool { return in_array('ROLE_ADMIN', $this->roles); }
    public function isSuperAdmin(): bool { return in_array('ROLE_SUPER_ADMIN', $this->roles); }

    public function getDisplayUsername(): string
    {
        $name = trim($this->username ?? 'Utilisateur', '[]');

        if ($this->isSuperAdmin()) {
            return "[[$name]]";
        }

        if ($this->isAdmin()) {
            return "[$name]";
        }

        return $name;
    }

    public function getLastLogin(): ?\DateTimeInterface { return $this->lastLogin; }
    public function setLastLogin(?\DateTimeInterface $lastLogin): self { $this->lastLogin = $lastLogin; return $this; }

    public function getLastPasswordRequestAt(): ?\DateTimeInterface { return $this->lastPasswordRequestAt; }
    public function setLastPasswordRequestAt(?\DateTimeInterface $date): self { $this->lastPasswordRequestAt = $date; return $this; }

    public function getPlainPassword(): ?string { return $this->plainPassword; }
    public function setPlainPassword(?string $plainPassword): self { $this->plainPassword = $plainPassword; return $this; }

    public function getTopics(): Collection { return $this->topics; }
    public function addTopic(Topic $topic): self
    {
        if (!$this->topics->contains($topic)) {
            $this->topics[] = $topic;
            $topic->setUser($this);
        }
        return $this;
    }
    public function removeTopic(Topic $topic): self
    {
        if ($this->topics->removeElement($topic)) {
            if ($topic->getUser() === $this) {
                $topic->setUser(null);
            }
        }
        return $this;
    }

    public function getPosts(): Collection { return $this->posts; }
    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setUser($this);
        }
        return $this;
    }
    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }
        return $this;
    }

    public function getAnnouncements(): Collection { return $this->announcements; }
    public function addAnnouncement(Announcement $announcement): self
    {
        if (!$this->announcements->contains($announcement)) {
            $this->announcements[] = $announcement;
            $announcement->setAuthor($this);
        }
        return $this;
    }
    public function removeAnnouncement(Announcement $announcement): self
    {
        if ($this->announcements->removeElement($announcement)) {
            if ($announcement->getAuthor() === $this) {
                $announcement->setAuthor(null);
            }
        }
        return $this;
    }

    public function getFavoriteTopics(): Collection { return $this->favoriteTopics; }
    public function addFavoriteTopic(Topic $topic): self
    {
        if (!$this->favoriteTopics->contains($topic)) {
            $this->favoriteTopics->add($topic);
        }
        return $this;
    }
    public function removeFavoriteTopic(Topic $topic): self
    {
        $this->favoriteTopics->removeElement($topic);
        return $this;
    }

    public function __toString(): string { return $this->getDisplayUsername(); }

    public function getAvatarPath(): string
    {
        return $this->avatar ?? 'default-avatar.png';
    }

    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): self
    {
        $this->resetToken = $resetToken;
        return $this;
    }

    public function getTokenExpiresAt(): ?\DateTimeInterface
    {
        return $this->tokenExpiresAt;
    }

    public function setTokenExpiresAt(?\DateTimeInterface $tokenExpiresAt): self
    {
        $this->tokenExpiresAt = $tokenExpiresAt;
        return $this;
    }
}
