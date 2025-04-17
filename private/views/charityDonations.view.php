<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityDonations.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">
            <div class="top-half">
            <div class="top-bar">
                </div>
                <div class="stats">
                    <div class="stat-item">                                   
                            <div class="stat-title">Total Requests</div>
                            <div class="stat-value"><?= isset($AllReqCount) ? htmlspecialchars($AllReqCount) : 0 ?></div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">Accepted</div>
                            <div class="stat-value"><?= isset($AccReqCount) ? htmlspecialchars($AccReqCount) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">Rejected</div>
                            <div class="stat-value"><?= isset($RejReqCount) ? htmlspecialchars($RejReqCount) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">No response</div>
                            <div class="stat-value"><?= isset($PenReqCount) ? htmlspecialchars($PenReqCount) : 0 ?></div>
                        </div>
                    </div>
                </div>
                <div class="complaints-status">
                    <div class="table-container">
                        <h2>Sent Donation Requests</h2>
                        <div class="toggle-slider">
                            <button class="toggle-option1 active" data-status="all">All</button>
                            <button class="toggle-option1" data-status="yet-to-decide">Pending</button>
                            <button class="toggle-option1" data-status="accepted">Accepted</button>
                            <button class="toggle-option1" data-status="rejected">Rejected</button>
                        </div>
                        <table class="admin-order-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Shop</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rows): ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td class="date"><?= htmlspecialchars($row->date) ?></td>
                                            <td>
                                                <?php foreach ($shopRows as $shopRow): ?>
                                                    <?php if ($shopRow->id == $row->business_id): ?>
                                                        <?= htmlspecialchars($shopRow->name) ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td><?= htmlspecialchars($row->title) ?></td>
                                            <?php if(htmlspecialchars($row->status)==2): ?>
                                                <td><button class="status ongoing">Accepted</button></td>
                                            <?php elseif(htmlspecialchars($row->status)==0): ?>
                                                <td><button class="status draft">Pending</button></td>
                                            <?php elseif(htmlspecialchars($row->status)==1): ?>
                                                <td><button class="status closed">Rejected</button></td>
                                            <?php endif; ?>    
                                            <td class="action">
                                                <button class="action-btn edit">View More</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <tr><td colspan="5"><h4>You currently have 0 donation requests.</h4></td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="stats">
                    <div class="stat-item_r">                                   
                            <div class="stat-title">Total Requests</div>
                            <div class="stat-value"><?= isset($AllReqCount_r) ? htmlspecialchars($AllReqCount_r) : 0 ?></div>
                    </div>
                    <div class="stat-item_r">
                        <div>
                            <div class="stat-title">Accepted</div>
                            <div class="stat-value"><?= isset($AccReqCount_r) ? htmlspecialchars($AccReqCount_r) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item_r">
                        <div>
                            <div class="stat-title">Rejected</div>
                            <div class="stat-value"><?= isset($RejReqCount_r) ? htmlspecialchars($RejReqCount_r) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item_r">
                        <div>
                            <div class="stat-title">No response</div>
                            <div class="stat-value"><?= isset($PenReqCount_r) ? htmlspecialchars($PenReqCount_r) : 0 ?></div>
                        </div>
                    </div>
                </div>

                <div class="complaints-status">
                    <div class="table-container">
                        <h2>Recieved Donation Requests</h2>
                        <div class="toggle-slider">
                            <button class="toggle-option2 active" data-status="all">All</button>
                            <button class="toggle-option2" data-status="yet-to-decide">Yet To Decide</button>
                            <button class="toggle-option2" data-status="accepted">Accepted</button>
                            <button class="toggle-option2" data-status="rejected">Rejected</button>
                        </div>
                        <table class="admin-order-table2">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Shop</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rows_r): ?>
                                    <?php foreach ($rows_r as $row): ?>
                                        <tr 
                                            data-id="<?= $row->id ?>"
                                            data-message="<?= htmlspecialchars($row->message) ?>"
                                            data-food-items="<?= htmlspecialchars($row->food_items) ?>"
                                            data-reply-message="<?= htmlspecialchars($row->reply_message ?? '') ?>"
                                        >
                                            <td class="date"><?= htmlspecialchars($row->date) ?></td>
                                            <td>
                                                <?php foreach ($shopRows as $shopRow): ?>
                                                    <?php if ($shopRow->id == $row->business_id): ?>
                                                        <?= htmlspecialchars($shopRow->name) ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td><?= htmlspecialchars($row->title) ?></td>
                                            <?php if(htmlspecialchars($row->status)=='accepted'): ?>
                                                <td><button class="status ongoing">Accepted</button></td>
                                            <?php elseif(htmlspecialchars($row->status)=='pending'): ?>
                                                <td><button class="status draft">Pending</button></td>
                                            <?php elseif(htmlspecialchars($row->status)=='rejected'): ?>
                                                <td><button class="status closed">Rejected</button></td>
                                            <?php endif; ?>    
                                            <td class="action">
                                                <button class="action-btn edit">View More</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <tr><td colspan="5"><h4>You currently have 0 donation requests.</h4></td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal HTML structure -->
<div id="requestModal" class="modal-overlay">
    <form class="modal-container" method="POST" action="<?=ROOT?>/charity/sendDonationRequest/<?= $id ?>">
        <div class="modal-header">
        <h3 class="modal-title">Request Details</h3>
        <button type="button" class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <div class="info-group">
                <div class="info-label">Status</div>
                <div class="info-value">
                    <span id="modal-status" class="status-badge"></span>
                </div>
            </div>
            <div class="info-group">
                <div class="info-label">Date</div>
                <div id="modal-date" class="info-value"></div>
            </div>
            <div class="info-group">
                <div class="info-label">Business</div>
                <div id="modal-business" class="info-value"></div>
            </div>
            <div class="info-group">
                <div class="info-label">Title</div>
                <div id="modal-title" class="info-value"></div>
            </div>
            <div class="info-group">
                <div class="info-label">Message</div>
                <div id="modal-message" class="info-value"></div>
            </div>
            <div class="info-group">
                <div class="info-label">Food Items</div>
                <div id="modal-food-items" class="info-value"></div>
            </div>
            
            <!-- Reply message for accepted/rejected requests -->
            <div id="reply-message-container" class="reply-message" style="display: none;">
                <div class="info-label">Reply Message</div>
                <div id="modal-reply-message" class="info-value"></div>
            </div>

            <input type="hidden" name="status" id="status-input">
            <input type="hidden" name="donation_id" id="donation-id">
            
            <!-- Form for pending requests -->
            <div id="reply-form" class="reply-form">
                <div class="form-group">
                <label for="reply-message" class="form-label">Reply Message</label>
                <textarea name="reply-message" id="reply-message" class="form-control" rows="3" placeholder="Enter your response..."></textarea>
                </div>
            </div>
        </div>
        <div id="modal-footer" class="modal-footer">
            <button type="button" id="close-modal" class="modal-btn btn-cancel">Close</button>
            <div id="action-buttons" style="display: none;">
                <button type="submit" name="action" value="reject" id="reject-btn" class="modal-btn btn-reject">Reject</button>
                <button type="submit" name="action" value="accept" id="accept-btn" class="modal-btn btn-accept">Accept</button>
            </div>
        </div>
    </form>
</div>
    <?php echo $this->view('includes/footer')?>

<script>

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".take-action_r").forEach(button => {
        button.addEventListener("click", function () {
            let formId = this.getAttribute("data-form-id");
            document.getElementById(formId).submit();
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('requestModal');
  const closeBtn = document.querySelector('.modal-close');
  const closeBtnFooter = document.getElementById('close-modal');
  const acceptBtn = document.getElementById('accept-btn');
  const rejectBtn = document.getElementById('reject-btn');
  const actionButtons = document.getElementById('action-buttons');
  const replyForm = document.getElementById('reply-form');
  const replyMessageContainer = document.getElementById('reply-message-container');
  
  // Get all "View More" buttons
  const viewMoreButtons = document.querySelectorAll('.action-btn.edit');
  
  // Add click event to each View More button
  viewMoreButtons.forEach(button => {
    button.addEventListener('click', function() {
      const row = this.closest('tr');
      const date = row.querySelector('.date').textContent;
      const businessName = row.cells[1].textContent.trim();
      const title = row.cells[2].textContent.trim();
      const statusElement = row.cells[3].querySelector('button');
      const status = statusElement.textContent.toLowerCase();
      
      // Get data that's in the PHP row but not displayed in the table
      // This is a placeholder - in your actual implementation, you need to get this data
      // You might need to add data attributes to the row or use AJAX to fetch it
      // For demonstration, let's assume we have these values
      const rowData = row.dataset;
      const message = rowData.message || "No message provided."; // You'll need to populate this
      const foodItems = rowData.foodItems || "None specified."; // You'll need to populate this
      const replyMessage = rowData.replyMessage || ""; // You'll need to populate this
      const donationId = row.dataset.id;

      // Fill modal with data
      document.getElementById('donation-id').value = donationId;
      document.querySelector('.modal-container').action = `<?=ROOT?>/charity/sendDonationRequest/${donationId}`;
      document.getElementById('modal-date').textContent = date;
      document.getElementById('modal-business').textContent = businessName;
      document.getElementById('modal-title').textContent = title;
      document.getElementById('modal-message').textContent = message;
      document.getElementById('modal-food-items').textContent = foodItems;
      
      // Set status with appropriate styling
      const modalStatus = document.getElementById('modal-status');
      modalStatus.textContent = status.charAt(0).toUpperCase() + status.slice(1);
      modalStatus.className = 'status-badge';
      
      if (status === 'pending') {
        modalStatus.classList.add('status-pending');
        actionButtons.style.display = 'block';
        replyForm.style.display = 'block';
        replyMessageContainer.style.display = 'none';
      } else {
        if (status === 'accepted') {
          modalStatus.classList.add('status-accepted');
          replyMessageContainer.classList.add('reply-accepted');
        } else {
          modalStatus.classList.add('status-rejected');
          replyMessageContainer.classList.add('reply-rejected');
        }
        
        actionButtons.style.display = 'none';
        replyForm.style.display = 'none';
        
        // Show reply message for accepted/rejected requests
        document.getElementById('modal-reply-message').textContent = replyMessage || "No reply message provided.";
        replyMessageContainer.style.display = 'block';
      }    
      // Show modal
      modal.classList.add('active');
    });
  });
  
  // Close modal when clicking the X or Close button
  closeBtn.addEventListener('click', closeModal);
  closeBtnFooter.addEventListener('click', closeModal);
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      closeModal();
    }
  });
  
  function closeModal() {
    modal.classList.remove('active');
  }

  acceptBtn.addEventListener('click', function () {
    document.getElementById('status-input').value = 'accepted';
  });

  rejectBtn.addEventListener('click', function () {
    document.getElementById('status-input').value = 'rejected';
  });


});

</script>
<script src="<?=ASSETS?>/js/charityToggle.js"></script>
  
</body>
</html>