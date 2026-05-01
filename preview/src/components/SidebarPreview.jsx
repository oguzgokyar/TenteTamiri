export default function SidebarPreview({ items }) {
  return (
    <aside className="site-sidebar">
      <div className="widget-card">
        <p className="eyebrow">Sidebar</p>
        <h3>Blog ve single alanlari icin widget bolgesi</h3>
        <ul className="check-list">
          {items.map((item) => (
            <li key={item}>{item}</li>
          ))}
        </ul>
      </div>
      <div className="widget-card widget-card--accent">
        <p className="eyebrow">Elementor note</p>
        <p>Bu alan tema sidebar olarak kalir; icerik tarafi ise Elementor ile serbestce duzenlenebilir.</p>
      </div>
    </aside>
  );
}

