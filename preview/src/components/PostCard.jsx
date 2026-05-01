export default function PostCard({ category, title, excerpt }) {
  return (
    <article className="post-card">
      <div className="post-card__inner">
        <div className="post-card__media" />
        <div className="post-card__body">
          <p className="eyebrow">{category}</p>
          <h3>{title}</h3>
          <p>{excerpt}</p>
          <span className="text-link">Yaziyi incele</span>
        </div>
      </div>
    </article>
  );
}

