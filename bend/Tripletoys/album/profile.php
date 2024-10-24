<div class="profile-container">
    <h2>ข้อมูลผู้ใช้ที่สั่งซื้อ</h2>
    <p><strong>ชื่อ:</strong> <?= htmlspecialchars($userData['cr_name']); ?></p>
    <p><strong>นามสกุล:</strong> <?= htmlspecialchars($userData['cr_last']); ?></p>
    <p><strong>หมายเลขโทรศัพท์:</strong> <?= htmlspecialchars($userData['cr_tel']); ?></p>
    <p><strong>ที่อยู่:</strong> <?= htmlspecialchars($userData['cr_add']); ?></p>
    <p><strong>อีเมล:</strong> <?= htmlspecialchars($userData['cr_mail']); ?></p>

    <h3>ที่อยู่ในการจัดส่งปัจจุบัน</h3>
    <ul>
        <?php while ($address = $addresses_result->fetch_assoc()): ?>
            <li>
                <?= htmlspecialchars($address['address_text']); ?>
                <?php if ($address['is_default']): ?>
                    <strong>(ที่อยู่หลัก)</strong>
                <?php else: ?>
                    <a href="set_default_address.php?address_id=<?= $address['address_id']; ?>">ตั้งเป็นที่อยู่หลัก</a>
                <?php endif; ?>
            </li>
        <?php endwhile; ?>
    </ul>

    <a href="logout.php" class="btn btn-link btn-block">ออกจากระบบ</a>
    <a href="add_address.php" class="btn btn-outline-success btn-block">+ เพิ่มที่อยู่</a>
</div>
