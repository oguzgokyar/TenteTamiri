export default function ServiceCard({ tag, title, description }) {
  return (
    <article className="feature-card">
      <p className="eyebrow">{tag}</p>
      <h3>{title}</h3>
      <p>{description}</p>
    </article>
  );
}

