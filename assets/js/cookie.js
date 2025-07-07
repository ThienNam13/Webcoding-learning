// 📁 File: assets/js/cookie.js

// Lưu cookie với thời hạn tùy chọn (mặc định: 7 ngày)
function setCookie(name, value, days = 7) {
    const d = new Date();
    d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = `${name}=${value}; expires=${d.toUTCString()}; path=/`;
}

// Lấy giá trị cookie theo tên
function getCookie(name) {
    const cookies = document.cookie.split('; ');
    for (let c of cookies) {
        const [key, val] = c.split('=');
        if (key === name) return val;
    }
    return "";
}

// Xóa cookie
function deleteCookie(name) {
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

// Cập nhật danh sách món đã xem gần đây
function updateRecentlyViewed(itemId) {
    const key = 'recentViewedItems';
    const existing = getCookie(key);
    let items = existing ? existing.split(',') : [];

    // Đưa itemId lên đầu và loại bỏ trùng lặp
    items = [itemId, ...items.filter(id => id !== itemId)];
    if (items.length > 10) items = items.slice(0, 10); // Giới hạn 10 món gần nhất

    document.cookie = `${key}=${items.join(',')}; path=/`;
}
