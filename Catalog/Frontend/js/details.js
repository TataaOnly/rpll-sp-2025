function getQueryParam(name) {
    const url = new URL(window.location.href);
    return url.searchParams.get(name);
}

function renderDetail(product) {
    const container = document.getElementById('detailContainer');
    let images = Array.isArray(product.images) && product.images.length ? product.images : ['../../../images/noimg.png'];
    let imgIndex = 0;
    function getImgSrc(idx) {
        let file = images[idx];
        if (file.startsWith('..')) return file;
        if (file.startsWith('/')) return file;
        return '../../uploads/' + file;
    }
    container.innerHTML = `
        <div class="detail-flex">
            <div class="detail-left">
                <div class="image-box" id="imgBox">
                    <span class="arrow left" id="imgPrev">&lt;</span>
                    <img src="${getImgSrc(0)}" alt="Gambar Produk" id="detailImg" style="max-width:90%;max-height:90%;object-fit:contain;">
                    <span class="arrow right" id="imgNext">&gt;</span>
                </div>
                <div class="desc-label">Deskripsi</div>
                <div class="desc-box">${product.deskripsi ? product.deskripsi : '-'}</div>
            </div>
            <div class="detail-right">
                <div class="product-title">${product.nama}</div>
                <hr class="divider">
                <div class="info-list">
                    <span>Harga: Rp ${parseInt(product.harga).toLocaleString('id-ID')}</span>
                    <span>Stok: ${product.stok}</span>
                </div>
                <a class="order-link" href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $kontak['no_wa']); ?>"><button class="order-btn">Order Sekarang</button></a>
            </div>
        </div>
    `;
    // Slider logic
    const imgEl = document.getElementById('detailImg');
    document.getElementById('imgPrev').onclick = () => {
        imgIndex = (imgIndex - 1 + images.length) % images.length;
        imgEl.src = getImgSrc(imgIndex);
    };
    document.getElementById('imgNext').onclick = () => {
        imgIndex = (imgIndex + 1) % images.length;
        imgEl.src = getImgSrc(imgIndex);
    };
}

function renderError(msg) {
    document.getElementById('detailContainer').innerHTML = `<div style="color:red;">${msg}</div>`;
}

const id = getQueryParam('id');
if (!id) {
    renderError('ID produk tidak ditemukan di URL.');
} else {
    fetch('../Backend/detail_controller.php?id=' + encodeURIComponent(id))
        .then(res => res.json())
        .then(data => {
            if (data && !data.error) renderDetail(data);
            else renderError(data.error || 'Produk tidak ditemukan.');
        })
        .catch(() => renderError('Gagal memuat detail produk.'));
}