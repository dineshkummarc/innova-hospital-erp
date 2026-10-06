"use strict";

// Enhanced Chat Module JavaScript
// Modern chat functionality with improved UX

$(document).ready(function() {
    initializeChat();
    setupEventListeners();
    startAutoRefresh();
    
    // Initialize character counter
    updateCharacterCount();
    
    // Auto-scroll to bottom on page load
    scrollToBottom();
    
    // Hide flash messages
    $(".flashmessage").delay(3000).fadeOut(100);
});

// Initialize chat functionality
function initializeChat() {
    // Set initial active user if none selected
    if (!$('.chat-user.active').length && $('.chat-user').length) {
        $('.chat-user').first().addClass('active');
        selectUser($('.chat-user').first());
    }
    
    // Focus on input
    $('.chat-input').focus();
    
    // Protect modern structure from interference
    protectModernStructure();
}

// Protect modern chat structure from being overridden
function protectModernStructure() {
    // Monitor for changes to the chatters block
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                // Check if legacy buttons were inserted
                const $target = $(mutation.target);
                if ($target.is('#chattersBlock') || $target.closest('#chattersBlock').length) {
                    // If we detect old button structure, prevent it from showing
                    $target.find('.ca-btn, .ca-chat-btn').hide();
                    
                    // Ensure modern structure is still intact
                    if ($('.chat-user').length === 0) {
                        console.warn('Modern chat structure was removed, restoring...');
                        // You could reload the page or restore from backup here
                        location.reload();
                    }
                }
            }
        });
    });
    
    // Start observing
    const chattersBlock = document.getElementById('chattersBlock');
    if (chattersBlock) {
        observer.observe(chattersBlock, {
            childList: true,
            subtree: true
        });
    }
    
    // Also add a periodic check to ensure structure integrity
    setInterval(function() {
        // Hide any legacy buttons that might appear
        $('.ca-btn, .ca-chat-btn').hide();
        
        // Ensure modern users are visible
        $('.chat-user').show();
    }, 1000);
}

// Setup all event listeners
function setupEventListeners() {
    // Send message on button click
    $(document).on('click', '.send-btn', sendMessage);
    
    // Send message on Enter key
    $(document).on('keypress', '.chat-input', function(e) {
        if (e.which === 13 && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
    
    // Character counter
    $(document).on('input', '.chat-input', function() {
        updateCharacterCount();
        showTypingIndicator();
    });
    
    // User selection
    $(document).on('click', '.chat-user', function() {
        if (!$(this).hasClass('active')) {
            selectUser($(this));
        }
    });
    
    // Search functionality
    $(document).on('keyup', '#searchChat', function() {
        performSearch($(this).val());
    });
    
    // Scroll to load older messages
    $(document).on('scroll', '.chat-messages', function() {
        handleScroll();
    });
    
    // Emoji button (placeholder)
    $(document).on('click', '.emoji-btn', function() {
        showNotification('Emoji picker coming soon!', 'info');
    });
    
    // Attachment button (placeholder)
    $(document).on('click', '.attachment-btn', function() {
        showNotification('File attachment coming soon!', 'info');
    });
}

// Send message function
function sendMessage() {
    const messageInput = $('.chat-input');
    const message = messageInput.val().trim();
    const receiverId = $('#receiverId').val();
    
    if (!message) {
        showNotification('Please enter a message', 'warning');
        return;
    }
    
    if (!receiverId) {
        showNotification('Please select a user to chat with', 'warning');
        return;
    }
    
    // Show sending state
    const sendBtn = $('.send-btn');
    const originalHtml = sendBtn.html();
    sendBtn.html('<div class="loading"></div>').prop('disabled', true);
    
    // Hide typing indicator
    hideTypingIndicator();
    
    $.ajax({
        url: 'chat/sendChat?chat=' + encodeURIComponent(message) + '&receiverId=' + receiverId,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Add message to chat immediately
            const messageHtml = createMessageBubble(message, true, new Date());
            $('.chat-messages').append(messageHtml);
            
            // Clear input and reset button
            messageInput.val('');
            updateCharacterCount();
            scrollToBottom();
            
            // Show success feedback
            showNotification('Message sent', 'success', 2000);
        },
        error: function() {
            showNotification('Failed to send message. Please try again.', 'error');
        },
        complete: function() {
            sendBtn.html(originalHtml).prop('disabled', false);
            messageInput.focus();
        }
    });
}

// Select user function
function selectUser($userElement) {
    const userId = $userElement.data('id');
    
    // Update UI - ensure we maintain the modern structure
    $('.chat-user').removeClass('active');
    $userElement.addClass('active').removeClass('unread');
    
    // Remove unread badge from selected user
    $userElement.find('.unread-badge').remove();
    
    // Show loading state
    $('.chat-messages').html('<div class="text-center p-4"><div class="loading"></div><p class="mt-2">Loading conversation...</p></div>');
    
    $.ajax({
        url: 'chat/changeChat?id=' + userId,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update chat area
            $('.chat-messages').html(response.chats || '<div class="text-center p-4 text-muted">No messages yet. Start the conversation!</div>');
            
            // Update hidden inputs
            $('#receiverId').val(userId);
            $('#lastMessageId').val(response.lastMessageId || 0);
            $('#recentMessageId').val(response.recentId || 0);
            
            // Update chat header
            updateChatHeader(response.user || 'Unknown User');
            
            // Scroll to bottom
            scrollToBottom();
            
            // Ensure the selected user remains properly styled
            setTimeout(() => {
                $('.chat-user').removeClass('active');
                $userElement.addClass('active').removeClass('unread');
                $userElement.find('.unread-badge').remove();
            }, 100);
        },
        error: function() {
            $('.chat-messages').html('<div class="text-center p-4 text-danger">Failed to load conversation. Please try again.</div>');
            showNotification('Failed to load conversation', 'error');
        }
    });
}

// Update chat header
function updateChatHeader(username) {
    $('.chat-username').text(username);
    $('.activity-text').text('Online'); // Assume online for now
}

// Create message bubble HTML
function createMessageBubble(message, isSender, timestamp) {
    const timeStr = timestamp ? formatTime(timestamp) : '';
    const bubbleClass = isSender ? 'chat-sender' : 'chat-receiver';
    
    return `<div class="${bubbleClass}" title="${timeStr}">
                ${escapeHtml(message)}
                ${timeStr ? `<div class="message-time">${timeStr}</div>` : ''}
            </div>`;
}

// Format time for display
function formatTime(date) {
    return new Intl.DateTimeFormat('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    }).format(new Date(date));
}

// Escape HTML to prevent XSS
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Update character counter
function updateCharacterCount() {
    const input = $('.chat-input');
    const count = input.val().length;
    const maxLength = parseInt(input.attr('maxlength')) || 500;
    
    $('.character-count').text(`${count}/${maxLength}`);
    
    // Change color based on length
    if (count > maxLength * 0.9) {
        $('.character-count').addClass('text-danger').removeClass('text-warning');
    } else if (count > maxLength * 0.8) {
        $('.character-count').addClass('text-warning').removeClass('text-danger');
    } else {
        $('.character-count').removeClass('text-danger text-warning');
    }
}

// Show typing indicator
let typingTimeout;
function showTypingIndicator() {
    const indicator = $('#typingIndicator');
    
    // Clear existing timeout
    clearTimeout(typingTimeout);
    
    // Show indicator
    indicator.show();
    
    // Hide after 3 seconds of no typing
    typingTimeout = setTimeout(function() {
        hideTypingIndicator();
    }, 3000);
}

// Hide typing indicator
function hideTypingIndicator() {
    $('#typingIndicator').hide();
}

// Scroll to bottom of messages
function scrollToBottom() {
    const messagesContainer = $('.chat-messages');
    messagesContainer.animate({
        scrollTop: messagesContainer[0].scrollHeight
    }, 300);
}

// Handle scroll for loading older messages
let isLoadingOldMessages = false;
function handleScroll() {
    const container = $('.chat-messages');
    const scrollTop = container.scrollTop();
    const receiverId = $('#receiverId').val();
    const lastMessageId = $('#lastMessageId').val();
    
    // Load older messages when scrolled to top
    if (scrollTop === 0 && !isLoadingOldMessages && lastMessageId && lastMessageId !== '0') {
        isLoadingOldMessages = true;
        
        // Show loading indicator
        container.prepend('<div class="text-center p-2 loading-old-messages"><div class="loading"></div></div>');
        
        $.ajax({
            url: 'chat/getOldMessage?receiverId=' + receiverId + '&lastMessageId=' + lastMessageId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.chats) {
                    // Remove loading indicator
                    $('.loading-old-messages').remove();
                    
                    // Prepend older messages
                    container.prepend(response.chats);
                    $('#lastMessageId').val(response.lastMessageId);
                    
                    // Maintain scroll position
                    container.scrollTop(50);
                }
            },
            error: function() {
                showNotification('Failed to load older messages', 'error');
            },
            complete: function() {
                $('.loading-old-messages').remove();
                isLoadingOldMessages = false;
            }
        });
    }
}

// Search functionality
let searchTimeout;
function performSearch(searchTerm) {
    clearTimeout(searchTimeout);
    
    searchTimeout = setTimeout(function() {
        if (searchTerm.trim() === '') {
            // Reset to original list
            location.reload(); // Simple approach - in production, you'd want to restore from cache
            return;
        }
        
        $.ajax({
            url: 'chat/findChatPerson?search=' + encodeURIComponent(searchTerm),
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update admin and employee sections
                $('#adminChatters').html(response.admin || '<div class="text-center p-3 text-muted">No admins found</div>');
                $('#employeeChatters').html(response.employee || '<div class="text-center p-3 text-muted">No employees found</div>');
            },
            error: function() {
                showNotification('Search failed. Please try again.', 'error');
            }
        });
    }, 300); // Debounce search
}

// Auto-refresh messages
function startAutoRefresh() {
    setInterval(function() {
        const receiverId = $('#receiverId').val();
        const recentMessageId = $('#recentMessageId').val();
        
        if (!receiverId || receiverId === ' ') return;
        
        $.ajax({
            url: 'chat/checkChat?receiverId=' + receiverId + '&recentId=' + recentMessageId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if ($('#receiverId').val() === receiverId) {
                    if (response.currentChats) {
                        // Add new messages
                        $('.chat-messages').append(response.currentChats);
                        scrollToBottom();
                        
                        // Play notification sound (optional)
                        playNotificationSound();
                    }
                    
                    // Update recent message ID
                    if (response.recentId) {
                        $('#recentMessageId').val(response.recentId);
                    }
                    
                    // DON'T update chat list HTML to preserve modern styling
                    // The old response.html contains legacy button structure
                    // Instead, just update unread indicators if needed
                    if (response.html) {
                        updateUnreadIndicators(response.html);
                    }
                }
            },
            error: function() {
                // Silently fail for auto-refresh to avoid spam
                console.log('Auto-refresh failed');
            }
        });
    }, 3000); // Check every 3 seconds
}

// Update unread indicators without replacing the entire chat list
function updateUnreadIndicators(legacyHtml) {
    // Parse the legacy HTML to extract unread information
    const tempDiv = $('<div>').html(legacyHtml);
    
    // Find all buttons with newChat class (unread messages)
    tempDiv.find('.newChat').each(function() {
        const userId = $(this).data('id');
        const $modernUser = $('.chat-user[data-id="' + userId + '"]');
        
        if ($modernUser.length && !$modernUser.hasClass('unread')) {
            // Add unread indicator to modern structure
            $modernUser.addClass('unread');
            if (!$modernUser.find('.unread-badge').length) {
                $modernUser.append('<div class="unread-badge"><span class="badge badge-primary">•</span></div>');
            }
        }
    });
    
    // Remove unread indicators for users who no longer have unread messages
    $('.chat-user.unread').each(function() {
        const userId = $(this).data('id');
        const hasUnread = tempDiv.find('.newChat[data-id="' + userId + '"]').length > 0;
        
        if (!hasUnread) {
            $(this).removeClass('unread').find('.unread-badge').remove();
        }
    });
}

// Play notification sound (optional)
function playNotificationSound() {
    // Create audio element for notification sound
    // You can add an actual sound file here
    try {
        const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmEcBTuR2O/BdSYEK4DN8Nuc');
        audio.volume = 0.1;
        audio.play().catch(() => {}); // Ignore errors if sound fails
    } catch (e) {
        // Ignore sound errors
    }
}

// Show notification
function showNotification(message, type = 'info', duration = 3000) {
    // Remove existing notifications
    $('.chat-notification').remove();
    
    const notificationClass = {
        'success': 'alert-success',
        'error': 'alert-danger',
        'warning': 'alert-warning',
        'info': 'alert-info'
    }[type] || 'alert-info';
    
    const notification = $(`
        <div class="alert ${notificationClass} chat-notification" style="
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border: none;
            border-radius: 8px;
        ">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} mr-2"></i>
            ${escapeHtml(message)}
            <button type="button" class="close ml-2" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
    
    $('body').append(notification);
    
    // Auto-hide after duration
    setTimeout(() => {
        notification.fadeOut(300, () => notification.remove());
    }, duration);
    
    // Manual close
    notification.find('.close').on('click', () => {
        notification.fadeOut(300, () => notification.remove());
    });
}

// Mobile responsiveness
$(window).on('resize', function() {
    if ($(window).width() > 768) {
        // Desktop - ensure sidebar is visible
        $('.chat-sidebar').removeClass('active');
    }
});

// Mobile toggle functionality
$(document).on('click', '.mobile-chat-toggle', function() {
    $('.chat-sidebar').toggleClass('active');
    $(this).find('i').toggleClass('fa-comments fa-times');
});

// Mobile header menu toggle
$(document).on('click', '.chat-area-header::before', function() {
    $('.chat-sidebar').addClass('active');
});

// Close mobile sidebar when clicking outside
$(document).on('click', function(e) {
    if ($(window).width() <= 768) {
        if (!$(e.target).closest('.chat-sidebar, .mobile-chat-toggle, .chat-area-header').length) {
            $('.chat-sidebar').removeClass('active');
            $('.mobile-chat-toggle i').removeClass('fa-times').addClass('fa-comments');
        }
    }
});

// Close sidebar when selecting a user on mobile
$(document).on('click', '.chat-user', function() {
    if ($(window).width() <= 768) {
        setTimeout(() => {
            $('.chat-sidebar').removeClass('active');
            $('.mobile-chat-toggle i').removeClass('fa-times').addClass('fa-comments');
        }, 300);
    }
});

// Legacy compatibility - ensure old functionality still works
$(document).on('click', '.ca-chat-btn', function() {
    const $newElement = $('.chat-user[data-id="' + $(this).data('id') + '"]');
    if ($newElement.length) {
        selectUser($newElement);
    }
});

// Ensure old input still works
$(document).on('keypress', '.chatInput', function(e) {
    if (e.which === 13) {
        $('.chat-input').val($(this).val());
        sendMessage();
        $(this).val('');
    }
});

$(document).on('click', '.caSendBtn', function() {
    $('.chat-input').val($('.chatInput').val());
    sendMessage();
    $('.chatInput').val('');
});

console.log('Enhanced Chat Module loaded successfully!');