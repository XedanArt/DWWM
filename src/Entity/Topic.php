<?php

namespace App\Entity;

use App\Repository\TopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TopicRepository::class)]
#[ORM\Table(name: 'topic')]
class Topic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "Le titre du topic est obligatoire.")]
    #[Assert\Length(
        max: 150,
        maxMessage: "Le titre du topic ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $title = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: "Le contenu du topic est obligatoire.")]
    #[Assert\Length(
        max: 5000,
        maxMessage: "Votre message ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $content = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'topics')]
    #[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?User $author = null;

    #[ORM\ManyToOne(targetEntity: ForumSection::class, inversedBy: 'topics')]
    #[ORM\JoinColumn(name: 'section_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?ForumSection $section = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isPinned = false;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'topics', cascade: ['persist'])]
    #[ORM\JoinTable(name: 'topic_tag')]
    private Collection $tags;

    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'topic', cascade: ['remove'])]
    #[ORM\OrderBy(['createdAt' => 'DESC'])]
    private Collection $posts;

    #[ORM\Column(type: 'integer')]
    private int $viewCount = 0;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $lastActivity = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->tags = new ArrayCollection();
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getSection(): ?ForumSection
    {
        return $this->section;
    }

    public function setSection(?ForumSection $section): self
    {
        $this->section = $section;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function isPinned(): ?bool
    {
        return $this->isPinned;
    }

    public function setIsPinned(bool $isPinned): self
    {
        $this->isPinned = $isPinned;
        return $this;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addTopic($this); // relation bidirectionnelle
        }
        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeTopic($this); // relation bidirectionnelle
        }
        return $this;
    }

    public function clearTags(): self
    {
        foreach ($this->tags as $tag) {
            $tag->removeTopic($this); // nettoie la relation inverse
        }
        $this->tags->clear();
        return $this;
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function getPostCount(): int
    {
        return $this->posts->count();
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function setViewCount(int $viewCount): self
    {
        $this->viewCount = $viewCount;
        return $this;
    }

    public function incrementViewCount(): self
    {
        $this->viewCount++;
        return $this;
    }

    public function getLastActivity(): ?\DateTimeInterface
    {
        return $this->lastActivity;
    }

    public function setLastActivity(?\DateTimeInterface $lastActivity): self
    {
        $this->lastActivity = $lastActivity;
        return $this;
    }

    public function updateLastActivity(): self
    {
        if ($this->posts->isEmpty()) {
            $this->lastActivity = $this->createdAt;
        } else {
            $latestPost = $this->posts->first(); // grâce à @OrderBy DESC
            if ($latestPost) {
                $this->lastActivity = $latestPost->getCreatedAt();
            }
        }
        return $this;
    }

    public function __toString(): string
    {
        return $this->title ?? 'Topic';
    }
}